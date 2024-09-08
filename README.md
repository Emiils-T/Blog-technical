

# Simple Blog


This is an blog page project built using the Laravel framework, Tailwind CSS.

## Features

- User Registration & Authentication:
    - Users can register and log in to their accounts securely.
    - Only registered users can create posts and comments.


- Post Management:
    - Users can create, edit, and delete their own posts.
    - Posts can be assigned to multiple categories.
    - Featured image upload for posts (if implemented).


- Comment System:
    - Users can create comments on posts.
    - Users can edit and delete their own comments.


- Category Management:
    - Posts can be organized into categories.
    - Users can create new categories when creating or editing posts.


- Search Functionality:
    - Users can search for posts by title, body content, or categories.


- Responsive Design:
    - The blog is fully responsive and works on desktop and mobile devices.

## Prerequisites
- PHP 8.2
- Composer
- NPM
## 🚀 Getting started

Clone the project

```bash
  git clone https://github.com/Emiils-T/Blog-technical.git
```

Go to the project directory

```bash
  cd path/to/project
  cp .env.example .env
```

Install dependencies

```bash
  composer install
  npm install 
```
Generate application key, migrate the database and seed database with data
```bash
  php artisan key:generate
  php artisan migrate
  php artisan db:seed
```

## Deployment

To deploy this project, open up two seperate terminal windows and type in:

- 1
```bash
  php artisan serv
```
- 2
```bash
  npm run dev
```

Then type http://localhost:8000/ into your broswer.

## Usage
Once the application is running, you can:

1. Register a new account or log in with existing credentials.
2. Create new posts and assign categories.
3. Edit or delete your own posts.
4. Add comments to posts.
5. Edit or delete your own comments.
6. Use the search function to find posts by title, content, or category.
    
