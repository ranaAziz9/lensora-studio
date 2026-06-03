<!DOCTYPE html>
<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206250
  Section: DAR
  Date: 2/4/2026
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback | Lensora Studio</title>
    <link rel="stylesheet" href="../global/main.css">
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
<a href="#main-content" class="skip-link">Skip to main content</a>
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
       <!-- Header_nav -->
<?php include '../includes/header_nav.php'; ?>

    <main id="main-content" class="main-content">
        <!-- Hero section: page introduction -->
        <section class="hero hero-compact" aria-labelledby="feedback-hero-heading">
            <div class="container">
                <h1 id="feedback-hero-heading">Feedback</h1>
                <p>Client comments and ratings.</p>
            </div>
        </section>

        <!-- Feedback form section -->
        <section aria-labelledby="form-heading">
            <div class="container">
                <div class="section-header">
                    <h2 id="form-heading">Client Feedback Form</h2>
                    <div class="accent-line"></div>
                </div>

                <div style="max-width: 600px; margin: 0 auto;">
                    
                        
                    </div>

                    <form id="feedback-form" class="form-panel">
                        <div class="form-group">
                            <label for="name">Name <abbr title="required">*</abbr></label>
                            <input type="text" id="name" name="name" placeholder="Your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <abbr title="required">*</abbr></label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required>
                        </div>

                        <fieldset class="form-group">
                            <legend>How would you rate your experience? <abbr title="required">*</abbr></legend>
                            <div class="form-group-inline">
                                <label><input type="radio" name="rating" value="good" required> Good</label>
                                <label><input type="radio" name="rating" value="average" required> Average</label>
                                <label><input type="radio" name="rating" value="poor" required> Poor</label>
                            </div>
                        </fieldset>

                        <fieldset class="form-group">
                            <legend>Which services did you use? <abbr title="required">*</abbr></legend>
                            <ul class="form-checkbox-list">
                                <li><label><input type="checkbox" name="services" value="portrait"> Portrait photography</label></li>
                                <li><label><input type="checkbox" name="services" value="graduation"> Graduation photography</label></li>
                                <li><label><input type="checkbox" name="services" value="product"> Product photography</label></li>
                                <li><label><input type="checkbox" name="services" value="events"> Events &amp; parties</label></li>
                                <li><label><input type="checkbox" name="services" value="video"> Video production</label></li>
                            </ul>
                        </fieldset>

                        <div class="form-group">
                            <label for="style-preference">Which style do you prefer for future sessions?</label>
                            <select id="style-preference" name="style-preference">
                                <option>Select your preference</option>
                                <option>Indoor Studio</option>
                                <option>Outdoor Natural</option>
                                <option>Dark Editing Style</option>
                                <option>Bright Editing Style</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="comments">Additional comments</label>
                            <textarea id="comments" name="comments" placeholder="What went well? What should we improve?"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">Submit Feedback</button>
                        
                    </form>
                </div>
            </div>
        </section>

        <!-- FAQ section -->
        <section class="section-alt" aria-labelledby="faq-heading">
            <div class="container">
                <div class="section-header">
                    <h2 id="faq-heading">Frequently Asked Questions</h2>
                    <div class="accent-line"></div>
                </div>

                <div class="faq-grid">
                    <div class="info-card">
                        <h4>How long until I receive photos?</h4>
                        <p>Most galleries arrive within 5–7 business days. Rush options may be available.</p>
                    </div>
                    <div class="info-card">
                        <h4>Do you retouch skin and color?</h4>
                        <p>Yes—packages include tasteful retouching; heavier edits can be quoted separately.</p>
                    </div>
                    <div class="info-card">
                        <h4>Can I reschedule?</h4>
                        <p>Yes, with at least 48 hours’ notice in most cases. Check your confirmation email for details.</p>
                    </div>
                    <div class="info-card">
                        <h4>What is the cancellation policy?</h4>
                        <p>Cancel 48+ hours ahead for a full deposit refund; late cancellations may forfeit the deposit.</p>
                    </div>
                    <div class="info-card">
                        <h4>Do you sell prints?</h4>
                        <p>Standard and Premium packages include prints; additional sizes are available à la carte.</p>
                    </div>
                    <div class="info-card">
                        <h4>Outdoor sessions?</h4>
                        <p>We shoot outdoors year-round and scout locations with you during planning.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

   <!-- ================= footer ================= -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Modal section: confirmation message -->
    <div id="feedback-modal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; z-index: 1000;">
        <div class="modal-content" style="background: #fff; padding: 40px; border-radius: 16px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="font-size: 50px; margin-bottom: 15px;">✉️</div>
            <h2 style="margin-bottom: 10px;">Feedback Received!</h2>
            <p id="modal-msg" style="color: #666; margin-bottom: 25px; line-height: 1.5;"></p>
            <button id="close-feedback" class="btn btn-primary" style="width: 100%; padding: 12px; border-radius: 8px; border: none; cursor: pointer;">Back to Form</button>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {

    const feedbackForm = document.getElementById("feedback-form");
    const modal = document.getElementById("feedback-modal");
    const closeBtn = document.getElementById("close-feedback");
    const modalMsg = document.getElementById("modal-msg");

    if (feedbackForm) {

        feedbackForm.addEventListener("submit", function (e) {

            e.preventDefault();

            // Get form values
            const name = document.getElementById("name").value;

            const email = document.getElementById("email").value;

            const rating =
                document.querySelector('input[name="rating"]:checked')?.value;

            // Get checked services
            const services = [];

            document.querySelectorAll('input[name="services"]:checked')
            .forEach(service => {
                services.push(service.value);
            });

            const stylePreference =
                document.getElementById("style-preference").value;

            const comments =
                document.getElementById("comments").value;

            // Send data to PHP API
            fetch("../api/add-feedback.php", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({

                    name: name,
                    email: email,
                    rating: rating,
                    services: services,
                    style_preference: stylePreference,
                    comments: comments

                })

            })

            .then(response => response.json())

            .then(data => {

                if (data.status === "success") {

                    modalMsg.innerHTML =
                    `Thank you, <strong>${name}</strong>!
                    Your feedback has been submitted successfully.`;

                    modal.style.display = "flex";

                    feedbackForm.reset();

                } else {

                    alert(data.message);
                }
            })

            .catch(error => {

                console.error(error);

                alert("Something went wrong.");
            });

        });
    }

    closeBtn.addEventListener("click", function () {

        modal.style.display = "none";
    });

    window.onclick = function(event) {

        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

});
</script>