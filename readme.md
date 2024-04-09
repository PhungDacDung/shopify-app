## Setup:

```bash

git clone https://github.com/PhungDacDung/shopify-app.git

cd popuppopup_quickly
composer install
npm install
cp .env.example .env
APP_NAME=Popup Quickly
APP_URL=
DB_DATABASE=
SHOPIFY_API_KEY=
SHOPIFY_API_SECRET=
SHOPIFY_API_VERSION="2023-01"
SHOPIFY_APP_NAME="Popup Quickly"
SHOPIFY_API_SCOPES="read_themes,write_themes"
SHOPIFY_BILLING_ENABLED=true

php artisan key:generate

php artisan migrate

php artisan db:seed

app_store : https://()/data_request
          : https://()/redact
          : https://()/shop/redact
policy:
        : https://()/policy
```





**Note:**

## Describe

Popup Quick is your go-to app for creating and customizing stunning popups that captivate your customer.

Key Highlights:
1.Effortless Activation: Instantly enable the popup feature with a single click.
2.Tailored Customization: Design popups that align with your brand and style seamlessly.
3.Save and Apply: Save your popup designs for future use and effortlessly apply them.

## Features

Easy Creation and Editing
Change Any Image
Change Background Color and Text Color
Customize Title and Description


## usage scenario

Install the app:
1.Access the Popup Quick app.
2.After accessing the control panel page, click on the "Enable Popup" button.
3.Then, click on the "Customize Popup" button to design a custom popup window to your liking.
4.Afterward, click on the "Save" button to save the designed popup window.
5.Then, access your store and try it out.

