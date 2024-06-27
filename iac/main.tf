provider "linode" {
    token = var.linode_access_token
}

resource "linode_instance" "web-server" {
    image = "linode/ubuntu24.04"
    label = "Linode-terraform"

    region = "eu-west"
    # https://api.linode.com/v4/linode/types
    type            = "g6-nanode-1"
    authorized_keys = []
    tags            = ["terraform"]
    root_pass       = var.linode_root_password
}
