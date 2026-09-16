const fs = require('fs');
let code = fs.readFileSync('blog-data.php', 'utf8');
code = code.replace(/hospital''s/g, "hospital\\'s");
code = code.replace(/Medware''s/g, "Medware\\'s");
code = code.replace(/Don''t/g, "Don\\'t");
fs.writeFileSync('blog-data.php', code);
