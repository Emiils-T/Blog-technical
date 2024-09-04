


## Please implement a simple blog system using Laravel 11. The application should have the following features:
- User registration/authentication: Users should be able to register an account and log in. Handle authentication using Laravel’s built-in capabilities.✅
- CRUD operations for blog posts: Users should be able to Create, Read, Update, and Delete their own blog posts. Each blog post should include a title, body content, creation date and time, and the author’s name.
- Comments: Users should be able to post comments on blog posts. Users can only post a comment if they are logged in, and they may only delete their own comments.
- Categories: Users should have the ability to assign categories to their posts. A post can have many categories and a category can belong to many posts (Many-to-Many relationship).
- Search function: Users should be able to conduct a keyword search on blog posts (post title and body)

## To achieve this, you would make use of Laravel’s MVC design pattern, Eloquent ORM, and Blade templating engine with Tailwind CSS for front-end design.

## Additional Requirements:
- All user inputs are validated before being processed.
- Make use of Laravel’s Middleware for access control, e.g, ensuring only post authors can edit their own posts.
- All data displayed should be adequately sanitized to prevent cross-site scripting (XSS).

Once you have completed the task, please provide the entire codebase, including migrations and seeds for the database, as well as instructions on how to install and run the application.
