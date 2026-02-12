<?php
require_once 'config.php';
require_once 'includes/functions.php';

$siteName = getSetting('site_name', 'Stellorix Technologies');
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Terms &amp; Conditions — <?php echo htmlspecialchars($siteName); ?></title>
  <meta name="description" content="Terms and Conditions for <?php echo htmlspecialchars($siteName); ?>.">
  <style>
    :root{
      --max-width:900px;
      --muted:#6b7280;
      --accent:#0f62fe;
      --card:#ffffff;
      --bg:#f4f6fb;
      --radius:12px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      color-scheme: light;
    }
    html,body{height:100%;}
    body{
      margin:0;
      background:linear-gradient(180deg, #f8fafc 0%, var(--bg) 100%);
      display:flex;
      align-items:flex-start;
      justify-content:center;
      padding:36px 18px;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }
    .container{
      width:100%;
      max-width:var(--max-width);
      background:var(--card);
      box-shadow: 0 10px 30px rgba(18, 23, 38, 0.08);
      border-radius:var(--radius);
      padding:28px;
      box-sizing:border-box;
    }
    header{
      display:flex;
      align-items:center;
      gap:16px;
      margin-bottom:18px;
    }
    h1{margin:0;font-size:20px;}
    p.lead{margin:6px 0 0;color:var(--muted);font-size:14px;}
    nav.toc{
      margin-top:10px;
      border-top:1px solid #eef2f7;
      padding-top:12px;
      display:flex;
      gap:12px;
      flex-wrap:wrap;
    }
    .title{
        font-size:24px;
        margin-left: 260px;      
    }
    nav.toc a{
      text-decoration:none;
      font-size:13px;
      color:var(--accent);
    }
    article{margin-top:18px;line-height:1.6;color:#111827;}
    h2{font-size:16px;margin:18px 0 8px;}
    h3{font-size:14px;margin:12px 0 6px;}
    section{margin-bottom:10px;padding-bottom:8px;border-bottom:1px dashed #eef2f7;}
    .muted{color:var(--muted);font-size:13px;}
    ul{margin:8px 0 8px 20px;}
    footer{
      margin-top:18px;
      font-size:13px;
      color:var(--muted);
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      flex-wrap:wrap;
    }
    
    /* Responsive */
    @media (max-width:520px){
      .container{padding:18px;}
      .logo{width:44px;height:44px;font-size:18px}
    }
    @media (max-width:480px){
        header{flex-direction:column;align-items:flex-start;gap:8px;}
        .title{margin-left:0;font-size:20px;}
        }
      
  </style>
</head>
<body>
  <div class="container" role="main" aria-labelledby="title">
    <header>
      <div class="logo"></div>
      <div>
        <h1 class="title">Terms &amp; Conditions</h1>
      </div>
    </header>


    <article>
      <section id="intro">
        <h2>1. Introduction</h2>
        <p>
          These Terms &amp; Conditions ("Terms") govern your access to and use of the services,
          websites, applications and products (collectively, the "Services") provided by
          <strong><?php echo htmlspecialchars($siteName); ?></strong> ("<?php echo htmlspecialchars($siteName); ?>", "we", "us" or "our").
          By using our Services you agree to be bound by these Terms. If you do not agree,
          do not use the Services.
        </p>
      </section>

      <section id="definitions">
        <h2>2. Definitions</h2>
        <p>
          <strong>"User"</strong> means any individual or legal entity that uses our Services.
          <strong>"Client"</strong> means a User who has entered into a paid agreement with <?php echo htmlspecialchars($siteName); ?>.
        </p>
      </section>

      <section id="services">
        <h2>3. Services</h2>
        <p>
          <?php echo htmlspecialchars($siteName); ?> provides software development, consulting, maintenance, and related professional services.
          Specific features, scope, and deliverables are described in individual proposals, statements of work,
          or order forms which, when signed by both parties, become part of the agreement between Client and <?php echo htmlspecialchars($siteName); ?>.
        </p>
      </section>

      <section id="payments">
        <h2>4. Fees &amp; Payments</h2>
        <ul>
          <li>All fees are specified in the applicable proposal or invoice. Unless otherwise agreed, fees are due within 15 days of invoice.</li>
          <li>Late payments may incur interest at the lesser of 1.5% per month or the maximum allowed by law.</li>
          <li>Taxes: Client is responsible for all applicable taxes (except <?php echo htmlspecialchars($siteName); ?>'s income taxes).</li>
        </ul>
      </section>

      <section id="client-obligations">
        <h2>5. Client Obligations</h2>
        <p>
          Client will provide accurate information, timely approvals, access to systems and personnel as reasonably required.
          Delays in Client cooperation may affect project timelines and costs.
        </p>
      </section>

      <section id="ip">
        <h2>6. Intellectual Property</h2>
        <p>
          Unless otherwise agreed in writing, <?php echo htmlspecialchars($siteName); ?> retains ownership of pre-existing tools, libraries, templates,
          and methodologies used to perform the Services ("Background IP"). Client receives a non-exclusive license to any deliverables
          created specifically for the Client upon full payment. Parties may negotiate assignment of rights in a separate agreement.
        </p>
      </section>

      <section id="confidentiality">
        <h2>7. Confidentiality</h2>
        <p>
          Each party will keep confidential information of the other party in confidence and not disclose it except as required by law.
          Confidential information does not include information that is publicly available through no fault of the receiving party.
        </p>
      </section>

      <section id="privacy">
        <h2>8. Privacy</h2>
        <p>
          Our <a href="<?php echo defined('BASE_PATH') ? BASE_PATH : ''; ?>/privacy.php">Privacy Policy</a> explains how we collect and process personal data. By using our Services you agree
          to our collection and use of information as described in that policy.
        </p>
      </section>

      <section id="warranties">
        <h2>9. Warranties &amp; Disclaimer</h2>
        <p>
          <?php echo htmlspecialchars($siteName); ?> will perform services in a professional manner consistent with industry standards. Except as expressly provided,
          services are provided "AS IS" and <?php echo htmlspecialchars($siteName); ?> disclaims all other warranties, express or implied, including merchantability or fitness
          for a particular purpose to the fullest extent permitted by law.
        </p>
      </section>

      <section id="liability">
        <h2>10. Limitation of Liability</h2>
        <p>
          To the maximum extent permitted by law, <?php echo htmlspecialchars($siteName); ?>'s aggregate liability for claims arising out of or related to these Terms
          will not exceed the total amount of fees paid by Client to <?php echo htmlspecialchars($siteName); ?> under the specific order giving rise to the claim in the
          twelve (12) months preceding the claim. Neither party will be liable for indirect, incidental, special, punitive or consequential damages.
        </p>
      </section>

      <section id="indemnity">
        <h2>11. Indemnification</h2>
        <p>
          Client will indemnify and hold <?php echo htmlspecialchars($siteName); ?> harmless from claims, liabilities, losses, and expenses arising from Client's breach of these Terms,
          violation of law, or misuse of the Services.
        </p>
      </section>

      <section id="term-termination">
        <h2>12. Term &amp; Termination</h2>
        <p>
          These Terms remain in effect until terminated. Either party may terminate a Statement of Work for material breach if the breach remains
          uncured after 30 days' written notice. Termination does not relieve Client of the obligation to pay for Services performed prior to termination.
        </p>
      </section>

      <section id="changes">
        <h2>13. Changes to Terms</h2>
        <p>
          <?php echo htmlspecialchars($siteName); ?> may modify these Terms from time to time. We will notify you of material changes via the email on file or by posting them
          on our site. Continued use of the Services after changes constitutes acceptance of the updated Terms.
        </p>
      </section>

      <section id="dispute">
        <h2>14. Dispute Resolution &amp; Governing Law</h2>
        <p>
          These Terms are governed by the laws of India without regard to conflict-of-law rules.
          Parties will attempt to resolve disputes informally. If not resolved, disputes will be submitted to the courts located in Hyderabad, Telangana.
        </p>
      </section>

      <section id="general">
        <h2>15. General Provisions</h2>
        <ul>
          <li>Entire Agreement: These Terms and any signed Statements of Work constitute the entire agreement between the parties regarding the Services.</li>
          <li>Severability: If a provision is found unenforceable, the remaining provisions remain in effect.</li>
          <li>Assignment: Client may not assign its rights or obligations without <?php echo htmlspecialchars($siteName); ?>'s prior written consent.</li>
        </ul>
      </section>
     
    </article>

    <footer>
      <div class="muted">© <?php echo htmlspecialchars($siteName); ?> — All rights reserved.</div>
    </footer>
  </div>
</body></html>
