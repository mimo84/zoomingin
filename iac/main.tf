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
    private_key_openssh = file("~/.ssh/id_linode_ed25519")
}

resource "linode_instance" "web-server" {
    image = "linode/ubuntu24.04"
    label = "Linode-terraform"

    region = "eu-west"
    # https://api.linode.com/v4/linode/types
    type            = "g6-nanode-1"
    authorized_keys = [replace(data.tls_public_key.private_key_openssh-linode.public_key_openssh, "\n", "")]
    tags            = ["terraform"]
    root_pass       = var.linode_root_password
}

output "instance_ip" {
    value = linode_instance.web-server.ip_address
}
