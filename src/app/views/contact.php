<?php require 'templates/top.php';?>
<?php require 'templates/slider.php';?>
<style>
.form {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.form__input{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

.form__button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form__button:hover {
    background-color: #45a049;
}
</style>
<section class="section">
    <div class="section__heading"><i class="fa fa-envelope-o" aria-hidden="true"></i>Write to us</div>
    <div class="section__content">
        <div class="alert">
            <span class="alert__close">&#x2716;</span>
            <p class="alert__content"></p>
        </div>
        <form id="writetous" class="form" action="<?php echo $basePath; ?>/contact" enctype="multipart/form-data">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" class="form__input" name="fullname" placeholder="Your full name..">

            <label for="email">Email</label>
            <input type="email" id="email" class="form__input" name="email" placeholder="Your email address.." required="true">

            <label for="subject">Subject</label>
            <input type="text" id="subject" class="form__input" name="subject" placeholder="Mail subject..">

            <label for="message">Message</label>
            <textarea id="message" class="form__input" name="message" placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" class="form__button" value="Submit">
          </form>
      </div>
</section>
<script>
$(document).ready(function(){
    $('#writetous').submit(function(e){
        e.preventDefault();

        var form = this;
        var data = $(form).serialize();
        $.ajax({
            url: form.action,
            type: 'POST',
            data: data,
            success: function(response) {
                var response = JSON.parse(response);

                var res = '';

                if(response.success){
                    response = response.success;
                    $('.alert').removeClass('alert--error');
                    $('.alert').addClass('alert--success');
                    $('#writetous').trigger("reset");
                    res += '<b>Success!</b><br>';
                }else if(response.error){
                    response = response.error;
                    $('.alert').removeClass('alert--success');
                    $('.alert').addClass('alert--error');
                    res += '<b>Error!</b><br>';
                }

                for(var key in response){
                    res += response[key] + '<br>';
                }

                $('.alert').slideUp().slideDown('slow');
                $('.alert__content').html(res);
            }
        });
    });

    $('.alert__close').on('click', function(event){
        $('.alert').slideUp('slow');
    });
});
</script>
<?php require 'templates/bot.php';?>
