variable "linode_access_token" {
  type        = string
  description = "The access token to be able to create linode instances"
  sensitive   = true
}

variable "linode_root_password" {
  type        = string
  description = "The root password to access linode instance"
  sensitive   = true
}

variable "linode_root_ssh_pubkey" {
  description = "Public SSH keyfile for root account"
}

variable "zoomingin_domain" {
  description = "the domain for zoomingin.net this is expected to be a subdomain"
  type        = string
}
