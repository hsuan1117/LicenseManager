# License Manager

## Plan
* Code with language, content(base64)
* Project HasMany Codes
* Project HasMany Token
* Token BelongsTo Project with HasExpired, content (Random String), activated_ip (nullable) , activated_uname(nullable), activated_cpu(lscpu, nullable), activated_limit(限制數量) (可選是否限制)
* Activation with token, activated_at, activate_ip, , activated_uname, activated_cpu 
* When Activating, check count(activation) where token equals token.content must < token.activated_limit
* Must support Cloudflare LB IP Proxy
* Client with uname, ip -> Activate Server -> success or fail
