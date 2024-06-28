provider "linode" {
  token = var.linode_access_token
}

provider "tls" {
}

resource "tls_private_key" "ed25519-linode" {
  algorithm = "ED25519"
}

# Public key loaded from filesystem, using the Open SSH (RFC 4716) format
data "tls_public_key" "private_key_openssh-linode" {
  private_key_openssh = file(var.linode_root_ssh_pubkey)
}

resource "linode_instance" "web_server" {
  image = "linode/ubuntu24.04"
  label = "Linode-terraform"

  region = "eu-west"
  # https://api.linode.com/v4/linode/types
  type            = "g6-nanode-1"
  authorized_keys = [chomp(data.tls_public_key.private_key_openssh-linode.public_key_openssh)]
  tags            = ["terraform"]
  root_pass       = var.linode_root_password
}

resource "linode_domain" "zoomingin_domain" {
  domain    = var.zoomingin_domain
  soa_email = "hostmaster@${var.zoomingin_domain}"
  type      = "master"
}

resource "linode_domain_record" "a" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "A"
  name        = ""
  target      = linode_instance.web_server.ip_address
}

resource "linode_domain_record" "aaaa" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "AAAA"
  name        = ""
  target      = element(split("/", linode_instance.web_server.ipv6), 0)
}

resource "linode_domain_record" "cname-www" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "CNAME"
  name        = "www"
  target      = var.zoomingin_domain
}

resource "linode_domain_record" "cname-mail" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "CNAME"
  name        = "mail"
  target      = var.zoomingin_domain
}

resource "linode_domain_record" "mx" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "MX"
  name        = ""
  target      = "mail.${var.zoomingin_domain}"
  priority    = "10"
}

resource "linode_domain_record" "txt-spf" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "TXT"
  name        = ""
  target      = "v=spf1 mx -all"
}

resource "linode_domain_record" "txt-dmarc" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "TXT"
  name        = "_dmarc"
  target      = "v=DMARC1; p=reject"
}

resource "linode_domain_record" "caa" {
  domain_id   = linode_domain.zoomingin_domain.id
  record_type = "CAA"
  name        = ""
  target      = "letsencrypt.org"
  tag         = "issue"
}

output "instance_ip" {
  value = linode_instance.web_server.ip_address
}
