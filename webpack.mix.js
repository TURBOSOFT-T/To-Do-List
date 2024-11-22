const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.copyDirectory("resources/backend", "public/backend");
mix.copyDirectory("resources/frontend", "public/frontend");

mix.js("resources/js/app.js", "public/backend/js");
