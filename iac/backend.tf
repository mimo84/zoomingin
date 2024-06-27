terraform {
    required_version = ">= 1.1.0"

    required_providers {
        linode = {
            source  = "linode/linode"
            version = "2.23.0"
        }
    }

}
