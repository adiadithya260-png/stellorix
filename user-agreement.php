<?php
require_once 'config.php';
require_once 'includes/functions.php';

$siteName = getSetting('site_name', 'Stellorix Technologies');
// Optional: Use just the name if "Technologies" is too long, akin to "Flex Coders"
// $siteNameShort = str_replace(' Technologies', '', $siteName); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Agreement - <?php echo htmlspecialchars($siteName); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #ffffff;
            color: #1f2937;
            line-height: 1.7;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            padding: 3rem;
            border: 1px solid #d1d5db;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #000000;
        }

        .company-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .document-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }

        .last-updated {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }

        .section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .subsection-title {
            font-weight: 600;
            color: #374151;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        ul, ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }

        li {
            margin-bottom: 0.5rem;
        }

        .important-notice {
            background: #f9fafb;
            border: 1px solid #d1d5db;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .important-notice strong {
            display: block;
            margin-bottom: 0.5rem;
            color: #000000;
        }

        .warning-box {
            background: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .contact-section {
            background: #f9fafb;
            border: 1px solid #d1d5db;
            padding: 2rem;
            margin-top: 3rem;
        }

        .contact-section h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .contact-section p {
            margin-bottom: 0.5rem;
        }

        strong {
            font-weight: 600;
            color: #000000;
        }

        @media print {
            body {
                padding: 0;
            }
            .container {
                border: none;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0.5rem;
            }

            .container {
                padding: 1.5rem;
            }

            .company-name {
                font-size: 1.5rem;
            }

            .document-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="document-title">User Agreement</div>
        </div>

        <div class="content">
            <div class="important-notice">
                <strong>IMPORTANT NOTICE</strong>
                <p>Please read this User Agreement carefully before using <?php echo htmlspecialchars($siteName); ?> platform. By accessing or using our services, you agree to be bound by these terms and conditions.</p>
            </div>

            <!-- Section 1 -->
            <div class="section">
                <h2 class="section-title">1. Agreement to Terms</h2>
                <p>By creating an account, accessing, or using <?php echo htmlspecialchars($siteName); ?> educational platform ("Service"), you agree to comply with and be legally bound by the terms and conditions outlined in this User Agreement.</p>
                <p>If you do not agree to these terms, you must not access or use our services. We reserve the right to modify these terms at any time, and continued use of the Service constitutes acceptance of any modifications.</p>
            </div>

            <!-- Section 2 -->
            <div class="section">
                <h2 class="section-title">2. User Eligibility</h2>
                <p>To use <?php echo htmlspecialchars($siteName); ?> services, you must:</p>
                <ul>
                    <li>Be at least 13 years of age, or the age of majority in your jurisdiction</li>
                    <li>Have the legal capacity to enter into binding contracts</li>
                    <li>Provide accurate and complete registration information</li>
                    <li>Maintain the security of your account credentials</li>
                    <li>Not be prohibited from using the Service under applicable laws</li>
                </ul>
                <div class="info-box">
                    <strong>Parental Consent:</strong> If you are under 18 years of age, you must have permission from a parent or legal guardian to use our services.
                </div>
            </div>

            <!-- Section 3 -->
            <div class="section">
                <h2 class="section-title">3. Course Access &amp; Enrollment</h2>
                <div class="subsection-title">3.1 Course Registration</div>
                <p>Upon successful enrollment and payment, you will receive access to the course materials for the duration specified in your course package. Access may be time-limited or perpetual depending on the course purchased.</p>
                
                <div class="subsection-title">3.2 Learning Materials</div>
                <p>All course content, including but not limited to videos, text materials, assignments, quizzes, and projects, are the intellectual property of <?php echo htmlspecialchars($siteName); ?> and are provided for personal, non-commercial educational use only.</p>
                
                <div class="subsection-title">3.3 Content Restrictions</div>
                <ul>
                    <li>You may not share, distribute, or resell course materials</li>
                    <li>You may not record, copy, or download course content without authorization</li>
                    <li>You may not use course materials for commercial purposes</li>
                    <li>Account sharing is strictly prohibited</li>
                </ul>
            </div>

            <!-- Section 4 -->
            <div class="section">
                <h2 class="section-title">4. Payment Terms</h2>
                <div class="subsection-title">4.1 Pricing &amp; Payment</div>
                <p>All course fees are listed in Indian Rupees (INR) unless otherwise specified. Prices are subject to change without notice. Payment must be completed before accessing course materials.</p>
                
                <div class="subsection-title">4.2 Accepted Payment Methods</div>
                <ul>
                    <li>Credit/Debit Cards (Visa, Mastercard, RuPay)</li>
                    <li>UPI (Google Pay, PhonePe, Paytm)</li>
                    <li>Net Banking</li>
                    <li>Digital Wallets</li>
                </ul>
                
                <div class="subsection-title">4.3 Refund Policy</div>
                <p>Refunds are available within 7 days of purchase if less than 20% of the course content has been accessed. Refund requests must be submitted via email with a valid reason. Processing time is 7-14 business days.</p>
                
                <div class="warning-box">
                    <strong>No Refund Conditions:</strong> Refunds will not be issued if you have completed more than 20% of the course, downloaded course materials, or violated our terms of service.
                </div>
            </div>

            <!-- Section 5 -->
            <div class="section">
                <h2 class="section-title">5. Intellectual Property Rights</h2>
                <p>All content on <?php echo htmlspecialchars($siteName); ?> platform, including but not limited to text, graphics, logos, videos, audio, software, and course materials, is the exclusive property of <?php echo htmlspecialchars($siteName); ?> or its licensors and is protected by copyright, trademark, and other intellectual property laws.</p>
                
                <div class="subsection-title">5.1 License Grant</div>
                <p>Subject to your compliance with these terms, <?php echo htmlspecialchars($siteName); ?> grants you a limited, non-exclusive, non-transferable, revocable license to access and use the course materials for personal educational purposes only.</p>
                
                <div class="subsection-title">5.2 Prohibited Uses</div>
                <ul>
                    <li>Copying, modifying, or creating derivative works</li>
                    <li>Reverse engineering or decompiling any software</li>
                    <li>Removing copyright or proprietary notices</li>
                    <li>Using content for training AI models without permission</li>
                </ul>
            </div>

            <!-- Section 6 -->
            <div class="section">
                <h2 class="section-title">6. Privacy &amp; Data Protection</h2>
                <p>Your privacy is important to us. <?php echo htmlspecialchars($siteName); ?> collects and processes personal information in accordance with our Privacy Policy and applicable data protection laws including the Information Technology Act, 2000.</p>
                
                <div class="subsection-title">6.1 Information We Collect</div>
                <ul>
                    <li>Personal identification information (name, email, phone number)</li>
                    <li>Payment and billing information</li>
                    <li>Course progress and learning analytics</li>
                    <li>Device and browser information</li>
                    <li>Communication preferences</li>
                </ul>
                
                <div class="subsection-title">6.2 How We Use Your Information</div>
                <p>We use your information to provide services, process payments, improve user experience, send course updates, and comply with legal obligations. We do not sell your personal information to third parties.</p>
            </div>

            <!-- Section 7 -->
            <div class="section">
                <h2 class="section-title">7. User Conduct &amp; Responsibilities</h2>
                <p>As a user of <?php echo htmlspecialchars($siteName); ?>, you agree to:</p>
                <ol>
                    <li>Provide accurate and truthful information during registration</li>
                    <li>Maintain the confidentiality of your account credentials</li>
                    <li>Use the platform in compliance with all applicable laws</li>
                    <li>Respect the intellectual property rights of <?php echo htmlspecialchars($siteName); ?> and other users</li>
                    <li>Not engage in any activity that disrupts or interferes with the platform</li>
                    <li>Not use automated systems to access the platform without authorization</li>
                    <li>Not harass, abuse, or harm other users or instructors</li>
                    <li>Not post or share inappropriate, offensive, or illegal content</li>
                </ol>
                <div class="warning-box">
                    <strong>Violation Consequences:</strong> Violation of these terms may result in immediate suspension or termination of your account without refund, and may also result in legal action.
                </div>
            </div>

            <!-- Section 8 -->
            <div class="section">
                <h2 class="section-title">8. Certificates &amp; Credentials</h2>
                <div class="subsection-title">8.1 Certificate Issuance</div>
                <p>Upon successful completion of a course (achieving minimum required scores and completing all assessments), you may receive a certificate of completion from <?php echo htmlspecialchars($siteName); ?>.</p>
                
                <div class="subsection-title">8.2 Certificate Authenticity</div>
                <p>All certificates include a unique verification code that can be validated on our website. Certificates are digital and can be downloaded as PDF or shared via LinkedIn.</p>
                
                <div class="info-box">
                    <strong>Note:</strong> <?php echo htmlspecialchars($siteName); ?> certificates are not accredited academic degrees and do not guarantee employment. They serve as proof of course completion and skill development.
                </div>
            </div>

            <!-- Section 9 -->
            <div class="section">
                <h2 class="section-title">9. Disclaimer of Warranties</h2>
                <p><?php echo htmlspecialchars($siteName); ?> platform and all course content are provided "as is" and "as available" without warranties of any kind, either express or implied, including but not limited to:</p>
                <ul>
                    <li>Warranties of merchantability or fitness for a particular purpose</li>
                    <li>Warranties that the service will be uninterrupted or error-free</li>
                    <li>Warranties regarding the accuracy or completeness of content</li>
                    <li>Warranties that defects will be corrected</li>
                </ul>
                <p>We do not guarantee that our courses will result in specific career outcomes, salary increases, or job placements.</p>
            </div>

            <!-- Section 10 -->
            <div class="section">
                <h2 class="section-title">10. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, <?php echo htmlspecialchars($siteName); ?> shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to:</p>
                <ul>
                    <li>Loss of profits or revenue</li>
                    <li>Loss of data or information</li>
                    <li>Loss of business opportunities</li>
                    <li>Personal injury or property damage</li>
                    <li>Cost of substitute services</li>
                </ul>
                <p>Our total liability for all claims related to the service shall not exceed the amount you paid for the specific course in question.</p>
            </div>

            <!-- Section 11 -->
            <div class="section">
                <h2 class="section-title">11. Modifications to Terms</h2>
                <p><?php echo htmlspecialchars($siteName); ?> reserves the right to modify or update these terms at any time. Changes will be effective immediately upon posting to our website. We will notify users of significant changes via email or platform notification.</p>
                <p>Your continued use of the Service after changes are posted constitutes acceptance of the modified terms. If you do not agree to the changes, you must discontinue use of the Service.</p>
            </div>

            <!-- Section 12 -->
            <div class="section">
                <h2 class="section-title">12. Account Termination</h2>
                <div class="subsection-title">12.1 Termination by User</div>
                <p>You may terminate your account at any time by contacting our support team. Upon termination, you will lose access to all course materials and your account data may be permanently deleted.</p>
                
                <div class="subsection-title">12.2 Termination by <?php echo htmlspecialchars($siteName); ?></div>
                <p>We reserve the right to suspend or terminate your account immediately, without notice, for any violation of these terms, fraudulent activity, or any conduct that we deem harmful to our platform or other users.</p>
            </div>

            <!-- Section 13 -->
            <div class="section">
                <h2 class="section-title">13. Governing Law &amp; Jurisdiction</h2>
                <p>These terms shall be governed by and construed in accordance with the laws of India, without regard to conflict of law principles. Any disputes arising from these terms or your use of the Service shall be subject to the exclusive jurisdiction of the courts located in Hyderabad, Telangana, India.</p>
            </div>

            <!-- Section 14 -->
            <div class="section">
                <h2 class="section-title">14. Entire Agreement</h2>
                <p>This User Agreement, together with our Privacy Policy and any other legal notices published on the platform, constitutes the entire agreement between you and <?php echo htmlspecialchars($siteName); ?> regarding the use of our services.</p>
                <p>If any provision of these terms is found to be invalid or unenforceable, the remaining provisions shall continue in full force and effect.</p>
            </div>
        </div>
    </div>
</body>
</html>
