<?php
if (!isset($basePath)) $basePath = defined('BASE_PATH') ? BASE_PATH : '';
if (!isset($logoUrl)) $logoUrl = $basePath . '/assets/images/stellorix-logo-full.png';
$logoIconUrl = rtrim($basePath, '/') . '/assets/images/logo-icon.png?v=' . (file_exists(__DIR__ . '/../assets/images/logo-icon.png') ? filemtime(__DIR__ . '/../assets/images/logo-icon.png') : 1);
if (!isset($siteName)) $siteName = 'Stellorix Technologies';
if (!isset($siteUrl)) $siteUrl = defined('SITE_URL') ? SITE_URL : '';

// SEO defaults
$defaultDescription = 'Stellorix Technologies offers professional IT training courses including Data Science, Full Stack Development, Data Analytics, and more. Join 10,000+ students and advance your tech career.';
$defaultKeywords = 'IT training, Data Science course, Full Stack Development, Data Analytics, MERN Stack, UI/UX Design, SAP training, Digital Marketing, Hyderabad, online courses, certification';
$pageDescription = isset($pageDescription) ? $pageDescription : $defaultDescription;
$pageKeywords = isset($pageKeywords) ? $pageKeywords : $defaultKeywords;
$canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : $siteUrl;
$ogImage = isset($ogImage) ? $ogImage : $siteUrl . '/assets/images/og-image.svg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' – ' : ''; ?><?php echo htmlspecialchars($siteName); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($siteName); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:title" content="<?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' – ' : ''; ?><?php echo htmlspecialchars($siteName); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($siteName); ?>">
    <meta property="og:locale" content="en_IN">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' – ' : ''; ?><?php echo htmlspecialchars($siteName); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage); ?>">
    
    <!-- Favicons -->
    <?php if (file_exists(__DIR__ . '/../assets/images/logo-icon.png')): ?>
    <link rel="icon" href="<?php echo $basePath; ?>/assets/images/logo-icon.png" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo $basePath; ?>/assets/images/logo-icon.png">
    <?php endif; ?>
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assets/css/course-colors.css?v=<?php echo time(); ?>">
    
    <!-- Structured Data / JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "<?php echo htmlspecialchars($siteName); ?>",
        "url": "<?php echo htmlspecialchars($siteUrl); ?>",
        "logo": "<?php echo htmlspecialchars($siteUrl); ?>/assets/images/stellorix-logo-full.png",
        "description": "<?php echo htmlspecialchars($defaultDescription); ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "2nd floor, Jaya Sudha Heights, Plot No. 462, 100 Feet Rd",
            "addressLocality": "Madhapur, Hyderabad",
            "addressRegion": "Telangana",
            "postalCode": "500081",
            "addressCountry": "IN"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-6281642951",
            "contactType": "customer service",
            "availableLanguage": ["English", "Hindi", "Telugu"]
        },
        "sameAs": [
            "<?php echo isset($linkedin) ? htmlspecialchars($linkedin) : ''; ?>",
            "<?php echo isset($instagram) ? htmlspecialchars($instagram) : ''; ?>",
            "<?php echo isset($facebook) ? htmlspecialchars($facebook) : ''; ?>"
        ]
    }
    </script>
</head>
<body class="light">
    <!-- Skip to Main Content (Accessibility) -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Animated Clouds Background – Brand Blue Theme -->
    <div class="clouds" aria-hidden="true">
        <div class="cloud cyan-bright" style="width:300px;height:300px;top:10%;left:5%;--start-x:-200px;--start-y:0;--end-x:120vw;--end-y:30vh;animation-duration:20s;"></div>
        <div class="cloud blue-royal" style="width:350px;height:350px;top:40%;left:-20%;--start-x:-250px;--start-y:50px;--end-x:120vw;--end-y:-20vh;animation-duration:25s;"></div>
        <div class="cloud cyan-sky" style="width:250px;height:250px;top:70%;left:10%;--start-x:0;--start-y:100px;--end-x:100vw;--end-y:-50vh;animation-duration:15s;"></div>
        <div class="cloud blue-deep" style="width:400px;height:400px;top:20%;left:70%;--start-x:0;--start-y:-200px;--end-x:-120vw;--end-y:40vh;animation-duration:22s;"></div>
        <div class="cloud blue-cobalt" style="width:280px;height:280px;top:60%;left:60%;--start-x:100px;--start-y:300px;--end-x:-100vw;--end-y:-30vh;animation-duration:18s;"></div>
    </div>

    <!-- Navbar -->
    <header class="site-header" role="banner">
        <div class="header-inner">
            <a href="<?php echo $basePath; ?>/" class="logo" aria-label="<?php echo htmlspecialchars($siteName); ?> - Home">
                <?php 
                $logoFullUrl = $basePath . '/assets/images/stellorix-logo-full.png';
                if (file_exists(__DIR__ . '/../assets/images/stellorix-logo-full.png')) {
                    $logoFullUrl .= '?v=' . filemtime(__DIR__ . '/../assets/images/stellorix-logo-full.png');
                }
                ?>
                <img src="<?php echo $logoFullUrl; ?>" alt="<?php echo htmlspecialchars($siteName); ?> Logo" class="logo-full-img" id="navLogo" width="200" height="50">
            </a>

            <nav class="nav-links" id="navLinks" role="navigation" aria-label="Main navigation">
                <a href="<?php echo $basePath; ?>/about.php">About</a>
                <a href="<?php echo $basePath; ?>/programs.php">Programs</a>
                <a href="<?php echo $basePath; ?>/career.php">Career</a>
                <a href="<?php echo $basePath; ?>/referrals.php">Referrals</a>
            </nav>

            <div class="header-actions">
                <!-- Theme Toggle Button -->
                <button class="theme-toggle" id="themeBtn" aria-label="Toggle dark/light theme" title="Toggle theme">
                    <span class="theme-icon-moon"><i class="bi bi-moon-fill"></i></span>
                    <span class="theme-icon-sun"><i class="bi bi-sun-fill"></i></span>
                </button>
                
                <!-- Mobile Menu Toggle -->
                <button class="hamburger" id="hamburger" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="navLinks">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    
    <main class="page-main" id="main-content" role="main">
