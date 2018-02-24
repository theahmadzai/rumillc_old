<header class="header">
    <?php if (!empty($data['news'])): ?>
    <div class="news"><b>UPDATE:</b><?php echo substr($data['news'], 0, 130); ?></div>
    <?php endif?>
    <div class="topbar">
        <a class="logo" href="<?php echo $basePath; ?>/">
            <img src="<?php echo $basePath; ?>/img/logo.png" alt="RumiLLC logo">
            <span></span>
        </a>
    </div>
    <nav class="nav">
        <a class="nav__link <?php echo ($page == 'home') ? 'nav__link--active' : ''; ?>" href="<?php echo $basePath; ?>/">Home</a>
        <a class="nav__link <?php echo ($page == 'products') ? 'nav__link--active' : ''; ?>" href="<?php echo $basePath; ?>/products">Products</a>
        <a class="nav__link <?php echo ($page == 'about') ? 'nav__link--active' : ''; ?>" href="<?php echo $basePath; ?>/about">About Us</a>
        <a class="nav__link <?php echo ($page == 'contact') ? 'nav__link--active' : ''; ?>" href="<?php echo $basePath; ?>/contact">Contact Us</a>
    </nav>
</header>
<script>
    $(document).ready(function(){
        $('.news').slideDown(1000);
    });
</script>
