<!-- Support Action Cards (3 Cards) -->
<div class="section_cards_container" id="contact">
    <!-- Card 1: Demo Request -->
    <div class="card">
        <h5>DEMO</h5>
        <h2>Request a <br> free demo</h2>

        <div class="requestBtn">
            <button id="requestDemoBtn"><i class="bi bi-lightning-fill"></i> Request</button>
        </div>

        <button id="requestDemoBtn2" style="text-decoration: none; color: var(--text-heading);">Request <i class="bi bi-arrow-up-right-square"></i></button>
    </div>

    <!-- Card 2: Call Us -->
    <div class="card">
        <h5>CALL US</h5>
        <h2>Have<br>doubt? Call <br>Us</h2>

        <div class="waveform">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', explode(',', $sitePhone)[0]); ?>"><button id="b2"><?php echo htmlspecialchars(explode(',', $sitePhone)[0]); ?> <i class="bi bi-arrow-up-right-square"></i></button></a>
    </div>

    <!-- Card 3: Query/Mail -->
    <div class="card">
        <h5>QUERY</h5>
        <h2>Have <br>query? Mail <br>Us</h2>

        <div class="dialogueBox_container">
            <div class="dialogue_box">Is it Online?</div>
            <div class="dialogue_box2">Yes! and Live class</div>
        </div>

        <a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>"><button id="b3" style="color: var(--text-heading);"><?php echo htmlspecialchars($siteEmail); ?> <i class="bi bi-arrow-up-right-square"></i></button>
        </a>
    </div>
</div>
