<?php
require_once 'config.php';
require_once 'includes/functions.php';

$siteName = getSetting('site_name', 'Stellorix Technologies');
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Privacy Policy - <?php echo htmlspecialchars($siteName); ?></title>
  <style>
    :root {
      --bg: #f7f9fc;
      --card: #ffffff;
      --accent: #0b69ff;
      --muted: #6b7280;
    }

    body {
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
      background: var(--bg);
      color: #111827;
      line-height: 1.6;
      margin: 0;
      padding: 32px;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
    }

    header {
      text-align: center;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 28px;
      margin: 0;
      color: var(--accent);
      text-transform: uppercase;
    }

    .card {
      background: var(--card);
      border-radius: 12px;
      padding: 22px;
      box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    }

    section {
      margin-bottom: 18px;
    }

    section h2 {
      font-size: 16px;
      margin: 0 0 8px;
    }

    section p {
      margin: 0;
      color: #111827;
    }

    dl {
      margin: 8px 0 0;
      padding-left: 18px;
    }

    footer {
      margin-top: 22px;
      color: var(--muted);
      font-size: 13px;
      text-align: center;
    }

    @media (max-width: 600px) {
      body {
        padding: 18px;
      }

      .card {
        padding: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Privacy Policy</h1>
    </header>

    <div class="card">

      <section id="introduction">
        <h2>1. Introduction</h2>
        <p>Welcome to <?php echo htmlspecialchars($siteName); ?>. We respect your privacy and are committed to protecting the personal information you share with us. This Privacy Policy explains what information we collect, why we collect it, how we use and share it, and the choices you have regarding your information when you use our website, apps, services, or when you communicate with us.</p>
      </section>

      <section id="information-we-collect">
        <h2>2. Information We Collect</h2>
        <p>We collect information you provide directly (for example, when you create an account, register for a course, or contact support) and information collected automatically (such as usage data and device information). Typical categories include name, email, phone number, billing details, profile data, learning progress, log files, IP address, and cookies or similar tracking technologies.</p>
      </section>

      <section id="how-we-use">
        <h2>3. How We Use Your Information</h2>
        <p>We use your information to deliver and improve our services, process payments, communicate account-related information, personalize content and recommendations, analyze usage patterns, and for security and fraud prevention. We may also use aggregated or anonymized data for research and product development.</p>
      </section>

      <section id="cookies-tracking">
        <h2>4. Cookies &amp; Tracking Technologies</h2>
        <p>We and our partners use cookies and similar technologies (such as local storage, pixels, and device identifiers) to remember your preferences, enable features, analyze site traffic, and serve relevant ads. You can manage cookie preferences in your browser settings or via tools provided on our website, but disabling cookies may affect certain features.</p>
      </section>

      <section id="data-sharing">
        <h2>5. Sharing and Disclosure</h2>
        <p>We do not sell your personal information. We may share information with service providers who perform services on our behalf (payment processors, cloud hosts, analytics providers), with legal authorities when required by law, and with third parties in connection with business transfers such as mergers or acquisitions. Any sharing is governed by contracts that require recipients to protect your data.</p>
      </section>

      <section id="security">
        <h2>6. Data Security</h2>
        <p>We implement reasonable technical and organizational measures to protect your information from unauthorized access, disclosure, alteration, or destruction. These measures include encryption in transit, access controls, and regular security assessments. However, no system is completely secure; if a breach occurs, we will follow applicable laws including notifying affected users when required.</p>
      </section>

      <section id="retention">
        <h2>7. Data Retention</h2>
        <p>We retain personal information as long as necessary to provide services, comply with legal obligations, resolve disputes, and enforce our agreements. Retention periods vary by data type and purpose; when no longer needed, we delete or anonymize the information in accordance with our data retention policies.</p>
      </section>

      <section id="children">
        <h2>8. Children’s Privacy</h2>
        <p>Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13 without parental consent. If you believe we have collected such information, please contact us and we will remove it promptly.</p>
      </section>

      <section id="your-rights">
        <h2>9. Your Rights and Choices</h2>
        <p>Depending on your jurisdiction, you may have rights to access, correct, delete, or port your personal data, and to restrict or object to certain processing. You can manage account settings, unsubscribe from marketing communications, and exercise rights by contacting us. We will respond to verified requests consistent with applicable law.</p>
      </section>

      <section id="contact-changes">
        <h2>10. Contact &amp; Changes to This Policy</h2>
        <p>If you have questions, requests, or concerns about this Privacy Policy or our practices, please contact us at:</p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars(getSetting('site_email', 'privacy@stellorix.in')); ?><br>
           <strong>Address:</strong> <?php echo htmlspecialchars(getSetting('site_address', 'Stellorix Technologies, Hyderabad, India')); ?></p>
        <p>We may update this policy from time to time. When we make material changes, we will provide notice on our site and update the effective date above.</p>
      </section>

    </div>

    <footer>
      <p>© <?php echo htmlspecialchars($siteName); ?>. All rights reserved.</p>
    </footer>
  </div>
</body></html>
