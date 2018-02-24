<?php
if (!empty($data['username'])) {
    $username = $data['username'];
} else {
    $username = 'unkown';
}
if (!empty($data['email'])) {
    $email = $data['email'];
} else {
    $email = 'unkown';
}
if (!empty($data['password'])) {
    $password = $data['password'];
} else {
    $password = 'unkown';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RumiLLC - Admin Panel</title>
<style>
body{
    margin:0;
    padding:0;
}
.topbar{
    width:100%;
    background: #f8f8f8;
    border-bottom:1px solid #efefef;
    display:flex;
    font-family:arial;
    align-items: center;
}
.title{
    padding:1.5rem 1rem;
    font-weight: bold;
    border-right:2px solid #efefef;
    background: #333;
    color:#ccc;
}
.welcome{
    flex:2;
    padding-left:2rem;
    text-align:center;
}
.back{
    padding:1.5rem 2rem;
    text-decoration: none;
    color:#fff;
    background:#333;
}
table {
    max-width:70%;
    border-collapse: collapse;
    margin: 1.5rem auto;
    font-family:arial;
    font-size:0.9em;
}
tr:nth-child(2n) {
    background: #f6f8fa;
}
thead th{
    padding: 6px 13px;
    border: 1px solid #dfe2e5;
    font-size: 16px;
    line-height: 1.5;
    word-wrap: break-word;
}
tbody td{
    padding: 0.6rem 2rem;
    border: 1px solid #dfe2e5;
}
h1{
    font-family:arial;
    text-align:center;
    font-size:2rem;
    font-weight:400;
    border-bottom:2px solid #efefef;
    padding:2rem 0;
}
.link{
    text-decoration: none;
    color:#333;
    padding:0.6rem 1rem;
    margin-left:1rem;
    background: #cbdbed;
    border-radius: 8px;
}
.link:hover{
    background:#b1d4f9;
}
.topper{
    position:fixed;
    bottom:1rem;
    right:1rem;
    text-decoration: none;
    color:#000;
    font-family:impact;
    font-weight: 600;
    font-size:1.6rem;
    background:#cbdbed;
    padding:.6rem 1rem;
    border-top-left-radius:25px;
    border-top-right-radius:25px;
    border-bottom-left-radius:6px;
    border-bottom-right-radius:6px;
}
.topper:hover{
    background:#b1d4f9;
}
.news-table td, .news-table th{
    border:1px solid #ccc;
}
.activate{
    text-decoration: underline;
    cursor:pointer;
}
.delete{
    text-decoration: underline;
    cursor:pointer;
    color:red;
}
.floatingbox{
    position:fixed;
    top:0;
    left:0;
    right:0;
    margin:0 auto;
    display:flex;
    flex-direction: column;
    justify-content: space-around;
}
.messagebox{
    min-width:400px;
    display:block;
    margin:.3rem auto;
    background:#333;
    border:1px solid #efefef;
    color:#ccc;
    padding:1rem 3rem;
    border-radius:10px;
}
form{
    width:70%;
    margin:0 auto;
    display:flex;
    justify-content: space-around;
    padding:1rem 0;
    background: #f9f9f9;
    box-sizing: border-box;
}
.update-box{
    flex-basis:85%;
    padding: 1rem;
    max-height:60px;
    color:#444;
    box-sizing: border-box;
    border: 1px solid #ccc;
    outline: 0;
    border-radius: 4px;
}
.update-submit{
    flex-basis:10%;
    background:#4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.update-submit:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
    <div class="floatingbox"></div>
    <a href="#top" class="topper">&uarr;</a>
    <div id="top" class="topbar">
        <div class="title">Dashboard</div>
        <a class="link" href="#admins">Admins</a>
        <a class="link" href="#news">Updates</a>
        <a class="link" href="#blocks">Blocks</a>
        <div class="welcome"><i>Welcome,</i> <b><?php echo $username; ?></b></div>
        <a class="back" href="<?php echo $basePath; ?>/" class="goback">&#x2190; Back</a>
    </div>

<?php
$query = $db->query("SELECT * FROM admins");
if ($query->num_rows > 0) {
    $admins = $query->fetch_all(MYSQLI_ASSOC);
}
?>
<h1 id="admins">Administrators</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($admins as $value): ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>

<?php
$query = $db->query("SELECT * FROM news");
if ($query->num_rows > 0) {
    $news = $query->fetch_all(MYSQLI_ASSOC);
}
?>
<h1 id="news">Updates</h1>
<form id="update-form" action="<?php echo $basePath; ?>/admin" enctype="multipart/form-data">
    <textarea class="update-box" name="update" placeholder="Type something..."></textarea>
    <input type="submit" class="update-submit">
</form>
<table class="news-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Update By</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($news as $value): ?>
        <tr style="background:#eee;" data-head="<?php echo $value['id']; ?>">
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['created_at']; ?></td>
            <td><?php echo $value['updated_at']; ?></td>
            <td><span data-id="<?php echo $value['id']; ?>" class="<?php echo ($value['active'] == true) ? 'inactive' : 'activate' ?>">activate</span></td>
            <td><span data-id="<?php echo $value['id']; ?>" class="delete">delete</span></td>
        </tr>
        <tr style="line-height:1.6rem;background:#fff;" data-body="<?php echo $value['id']; ?>">
            <td colspan="6"><?php echo $value['news']; ?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>
<!-- Scripts -->
<script src="<?php echo $basePath; ?>/js/app.dist.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $('.activate').on('click', function(){
            var activate = $(this);
            var id = $(this).data('id');
            $.post("<?php echo $basePath; ?>"+"/admin",{
                activate: id
            }, function(response){
                $('.inactive').addClass('activate');
                $('.inactive').removeClass('inactive');
                $(activate).removeClass('activate');
                $(activate).addClass('inactive');
                $('.floatingbox').append("<div class='messagebox'>"+response+"</div>");
                $(".messagebox").show().delay(2000).slideUp(function(){
                    $(this).remove();
                });
            });
        });

        $('.delete').on('click', function(){
            var remove = $(this);
            var id = $(this).data('id');

            $.post("<?php echo $basePath; ?>"+"/admin",{
                remove: id
            }, function(response){
                $('.floatingbox').append("<div class='messagebox'>"+response+"</div>");
                $(".messagebox").show().delay(2000).slideUp(function(){
                    $(this).remove();
                });
                $('tr[data-head=' + id + ']').fadeOut(function(){
                    $('tr[data-body=' + id + ']').fadeOut();
                });
            });
        });

        $('#update-form').on('submit', function(event){
            event.preventDefault();
            var form = this;
            var data = $(form).serialize();
        $.ajax({
            url: form.action,
            type: 'POST',
            data: data,
            success: function(response) {
                    $('.floatingbox').append("<div class='messagebox'>"+response+"</div>");
                    $(".messagebox").show().delay(2000).slideUp(function(){
                        $(this).remove();

                    });
                    location.reload();
                }
            });
        });
    });
</script>
</body>
</html>
