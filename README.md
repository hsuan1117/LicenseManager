# License Manager

## Plan
* Code with language, content(base64)
* Project HasMany Codes
* Activation HasOne Project with HasExpired, Token(Random String), activated_at, activated_ip, activated_uname, activated_cpu(lscpu)
* Must support Cloudflare LB IP Proxy
* Client with uname, ip -> Activate Server -> success or fail
