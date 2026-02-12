<!-- Support Banner -->
<section class="support-card animate-on-scroll" aria-labelledby="support-heading">
    <div class="support-text">
        <p class="support-card-para">SUPPORT</p>
        <h2 id="support-heading" class="support-card-heading"><?php echo htmlspecialchars($siteNameShort); ?><br>Academic<br>Support</h2>
        <p class="support-card-para-grey">
            Get better help from our best support team of <?php echo htmlspecialchars($siteNameShort); ?>
        </p>
    </div>

    <div class="support-images" aria-hidden="true">
        <div class="circle green"></div>
        <div class="circle blue"></div>
        <div class="circle yellow"></div>
        <?php
        $supportImg = (file_exists(__DIR__ . '/../../assets/images/Support.png'))
            ? $basePath . '/assets/images/Support.png'
            : $basePath . '/assets/images/Support.png';
        ?>
        <img class="man" src="<?php echo $supportImg; ?>" alt="Support Team" loading="lazy" width="300" height="300">
    </div>
</section>
