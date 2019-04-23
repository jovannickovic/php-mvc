# Custom PHP MVC
## Initial setup
---
- Change `RewriteBase` in *.htaccess* file inside **PUBLIC** folder.
- Fill in *config.php* file inside **APP** folder with your own parameters.
- A model is being loaded in the `__construct()` of homonymous file (named in plural, tho) in **APP/CONTROLLER**. File *Page.php* in **APP/MODEL** represents an example of how to deal with database.
- There are some *.css* & *.js* files with a few lines of some basic code just to make sure whether everything's connected well and working, so feel free to delete them/clean the code if not needed.
---