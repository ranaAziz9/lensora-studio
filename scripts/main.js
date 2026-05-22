/**
 * Lensora Studio — site interactivity
 * Plain JavaScript: navigation, forms, booking schedule.
 */

document.addEventListener("DOMContentLoaded", function () {
  updateActiveNavLink();
  setupFormValidation();
  setupBookingRequestForm();
  setupScheduleInteractivity();
  setupGalleryAnimations();
  setupServiceAnimations();
});

/**
 * Highlights the current page; supports gallery subpages via body[data-nav-active].
 */
function updateActiveNavLink() {
  const bodyActive = document.body.getAttribute("data-nav-active");
  const currentPage = window.location.pathname.split("/").pop() || "index.html";

  document.querySelectorAll(".nav-links a").forEach(function (link) {
    link.classList.remove("active");
    const href = link.getAttribute("href");
    if (bodyActive) {
      if (href === "work.html" && bodyActive === "work") {
        link.classList.add("active");
      }
    } else if (href === currentPage || (currentPage === "" && href === "index.html")) {
      link.classList.add("active");
    }
  });
}

function setupScheduleInteractivity() {
  var serviceSelect = document.getElementById("booking-service");
  var dateInput = document.getElementById("booking-date");
  var timeInput = document.getElementById("booking-time");
  var slotHint = document.getElementById("slot-hint");
  var serviceButtons = document.querySelectorAll(".service-btn");

  if (serviceButtons.length === 0) return;

  serviceButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      serviceButtons.forEach(function (b) {
        b.classList.remove("selected");
      });
      btn.classList.add("selected");
      var v = btn.getAttribute("data-service");
      if (serviceSelect && v) {
        serviceSelect.value = v;
      }
    });
  });

  if (serviceSelect) {
    serviceSelect.addEventListener("change", function () {
      var val = serviceSelect.value;
      serviceButtons.forEach(function (b) {
        b.classList.toggle("selected", b.getAttribute("data-service") === val);
      });
    });
  }

  document.querySelectorAll(".slot.available").forEach(function (slot) {
    slot.addEventListener("click", function () {
      document.querySelectorAll(".slot.selected").forEach(function (s) {
        s.classList.remove("selected");
      });
      slot.classList.add("selected");

      var date = slot.getAttribute("data-date");
      var time = slot.getAttribute("data-time");
      if (dateInput) dateInput.value = date;
      if (timeInput) timeInput.value = time;
      if (slotHint) {
        slotHint.textContent = "Date and time updated.";
      }
    });
  });
}

function setupBookingRequestForm() {
  var form = document.getElementById("booking-request-form");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var fd = new FormData(form);
    var name = fd.get("booking-name");
    var email = fd.get("booking-email");
    var service = fd.get("booking-service");
    var date = fd.get("booking-date");
    var time = fd.get("booking-time");

    var errors = [];
    if (!name || !String(name).trim()) errors.push("Name is required.");
    if (!email || !String(email).trim()) errors.push("Email is required.");
    else if (!isValidEmail(email)) errors.push("Enter a valid email address.");
    if (!service) errors.push("Select a service.");
    if (!date) errors.push("Preferred date is required.");
    if (!time || !String(time).trim()) errors.push("Preferred time is required.");

    if (errors.length > 0) {
      showNotification(errors.join("\n"), "error");
      return;
    }

    showNotification("Booking request submitted. The studio will follow up to confirm your session.", "success");
    form.reset();
    document.querySelectorAll(".slot.selected").forEach(function (s) {
      s.classList.remove("selected");
    });
    document.querySelectorAll(".service-btn.selected").forEach(function (b) {
      b.classList.remove("selected");
    });
    var hint = document.getElementById("slot-hint");
    if (hint) hint.textContent = "";
    console.log("Booking request:", Object.fromEntries(fd));
  });
}

function setupFormValidation() {
  var feedbackForm = document.getElementById("feedback-form");
  if (feedbackForm) {
    feedbackForm.addEventListener("submit", handleFormSubmit);
  }
}

function handleFormSubmit(e) {
  e.preventDefault();

  var form = e.target;
  var formData = new FormData(form);

  var name = formData.get("name");
  var email = formData.get("email");
  var rating = formData.get("rating");
  var services = formData.getAll("services");
  var contactMethod = formData.get("contact-method");
  var comments = formData.get("comments");

  var errors = [];

  if (!name || String(name).trim() === "") {
    errors.push("Name is required");
  }

  if (!email || String(email).trim() === "") {
    errors.push("Email is required");
  } else if (!isValidEmail(email)) {
    errors.push("Please enter a valid email address");
  }

  if (!rating) {
    errors.push("Please select a rating");
  }

  if (services.length === 0) {
    errors.push("Please select at least one service");
  }

  if (!contactMethod) {
    errors.push("Please select a preferred contact method");
  }

  if (errors.length > 0) {
    showNotification("Please fix the following errors:\n" + errors.join("\n"), "error");
  } else {
    showNotification("Thank you! Your feedback has been submitted successfully.", "success");
    form.reset();
    console.log("Form submitted:", {
      name: name,
      email: email,
      rating: rating,
      services: services,
      contactMethod: contactMethod,
      comments: comments
    });
  }
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(email));
}

function showNotification(message, type) {
  type = type || "info";

  var notification = document.createElement("div");
  notification.className = "notification notification-" + type;
  notification.innerHTML = message.replace(/\n/g, "<br>");

  notification.style.cssText =
    "position:fixed;top:20px;right:20px;padding:1.5rem;border-radius:0.5rem;color:white;font-weight:600;z-index:1000;max-width:400px;box-shadow:0 5px 15px rgba(0,0,0,0.2);";

  if (type === "success") {
    notification.style.backgroundColor = "#10b981";
  } else if (type === "error") {
    notification.style.backgroundColor = "#ef4444";
  } else {
    notification.style.backgroundColor = "#9b7ebd";
  }

  document.body.appendChild(notification);

  setTimeout(function () {
    notification.remove();
  }, 5000);
}

document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
  anchor.addEventListener("click", function (e) {
    var id = anchor.getAttribute("href");
    if (id.length > 1) {
      var target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: "smooth" });
      }
    }
  });
});

function setupGalleryAnimations() {
  var galleryItems = document.querySelectorAll(".gallery-item");
  if (galleryItems.length === 0) return;

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("fade-in");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: "0px 0px -100px 0px" }
  );

  galleryItems.forEach(function (item) {
    observer.observe(item);
  });
}

function setupServiceAnimations() {
  var serviceCards = document.querySelectorAll(".service-card");
  if (serviceCards.length === 0) return;

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry, index) {
        if (entry.isIntersecting) {
          entry.target.style.animation = "fadeIn 0.6s ease-out " + index * 0.1 + "s both";
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: "0px 0px -100px 0px" }
  );

  serviceCards.forEach(function (card) {
    observer.observe(card);
  });
}