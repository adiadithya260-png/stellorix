<!-- Company Logos Scroll Strip -->
<section class="section animate-on-scroll" id="ads" aria-label="Our hiring partners">
    <div class="scroll-container">
        <div class="scroll-content" role="marquee" aria-label="Companies where our students work">
            <?php
            // Static list of company logos
            $companyLogos = [
                'accenture.png',
                'coforge.png',
                'hcl.png',
                'ibm.png',
                'infosys.png',
                'lnt.png',
                'tcs.png',
                'tm.png',
                'wipro.png'
            ];
            
            // Display logos twice for seamless scroll
            for ($i = 0; $i < 2; $i++) {
                foreach ($companyLogos as $logo) {
                    $logoPath = $basePath . '/assets/images/companies/' . $logo;
                    $alt = $i === 0 ? pathinfo($logo, PATHINFO_FILENAME) . ' logo' : '';
                    $ariaHidden = $i === 1 ? ' aria-hidden="true"' : '';
                    echo '<img src="' . htmlspecialchars($logoPath) . '" alt="' . $alt . '" loading="lazy" width="120" height="60"' . $ariaHidden . '>';
                }
            }
            ?>
        </div>
    </div>
</section>
