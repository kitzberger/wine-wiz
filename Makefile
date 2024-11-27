development:
	composer install
	npm run build

production:
	composer install --no-dev
	npm install
	npm run build

import:
	./artisan migrate:fresh ; ./artisan app:import-excel
