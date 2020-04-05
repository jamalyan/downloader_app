# Downloader Application 

#### Commands for downloads
 
- Add new url to downloads -> php artisan downloads:add {url}
- Show list of downloads -> php artisan downloads:list

#### API Doc for downloads

- Add new url to downloads -> POST REQUEST `APP_URL` + `/api/downloads` (required parameter `url`)
- Show list of downloads -> GET REQUEST `APP_URL` + `/api/downloads`
