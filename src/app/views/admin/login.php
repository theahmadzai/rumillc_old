<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RumiLLC - Admin Login</title>
<style>
body{
    margin:0;
    padding:0;
}
.form{
    width:30%;
    margin:5rem auto;
    padding:2rem;
    background: #f9f9f9;
    font-family:arial;
}
h3{
    display:block;
    text-align:center;
    margin:1rem 0;
    color:#555;
    background: #f1f1f1;
    padding:1rem;
    border-radius:7px;
}
label{
    color:#666;
}
.input{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}
.button{
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight:bold;
}
a{
    text-decoration: none;
    color:#444;
    position:relative;
}
a:hover::before{
    content: 'Go back to RumiLLC Main Page';
    position:absolute;
    top:-40px;
    left:-100px;
    color:#fff;
    background:#000;
    opacity:0.8;
    display:block;
    width:250px;
    padding:.5rem 1rem;
    border-radius:5px;
}
p{
    padding:1rem 0;
    color:red;
}
</style>
</head>
<body>
    <form class="form" method="post" action="<?php echo $basePath; ?>/admin/login" enctype="multipart/form-data">
        <a href="<?php echo $basePath; ?>/" class="goback">&#x2190; Back</a>
        <?php if (!empty($data)): ?>
            <p>
                <?php echo $data['message']; ?>
            </p>
        <?php endif;?>
        <h3>RumiLLC - Admin Login</h3>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="input">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="input">

        <input type="submit" class="button">
    </form>
</body>
</html>
