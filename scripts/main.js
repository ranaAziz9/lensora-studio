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

// =========================
// Show Login / Register Tabs
// =========================
function showForm(type) {
    let forms = document.querySelectorAll("form");
    let btnLogin = document.getElementById("tab-login-btn");
    let btnRegister = document.getElementById("tab-register-btn");

    forms.forEach(f => f.classList.remove("active"));

    if (btnLogin) btnLogin.classList.remove("active");
    if (btnRegister) btnRegister.classList.remove("active");

    const activeForm = document.getElementById(type);
    if (activeForm) activeForm.classList.add("active");

    if (type === 'login') {
        btnLogin?.classList.add("active");
    } else {
        btnRegister?.classList.add("active");
    }
}


// =========================
// Handle URL Messages
// =========================
document.addEventListener("DOMContentLoaded", function () {

    const urlParams = new URLSearchParams(window.location.search);

    const error = urlParams.get('error');
    const success = urlParams.get('success');
    const tab = urlParams.get('tab');

    const errorBox = document.getElementById("error-alert");
    const successBox = document.getElementById("success-alert");

    // show correct tab
    if (tab) showForm(tab);

    // =========================
    // ERROR HANDLING
    // =========================
    if (error && errorBox) {
        errorBox.style.display = "block";

        if (error === 'invalid') {
            errorBox.innerText = "Invalid email or password ❌";
        }
        else if (error === 'exists') {
            errorBox.innerText = "Email already exists ⚠️";
        }
        else if (error === 'empty') {
            errorBox.innerText = "Please fill all fields ⚠️";
        }
        else if (error === 'weakpassword') {
            errorBox.innerText =
                "Password is too weak ❌ Must be 8+ characters, include uppercase, lowercase, number & symbol.";
        }
        else if (error === 'invalidname') {
            errorBox.innerText = "Name must contain letters only ❌";
        }
        else if (error === 'invalidemail') {
            errorBox.innerText = "Invalid email format ❌";
        }
    }

    // =========================
    // SUCCESS HANDLING
    // =========================
    if (success === 'registered' && successBox) {
        successBox.style.display = "block";
        successBox.innerText = "Account created successfully ✔️";
    }
});


// =========================
// Toggle Password Visibility
// =========================
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);

    if (!input) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

//Invalid email format
const params = new URLSearchParams(window.location.search);

const errorAlert = document.getElementById("error-alert");
const successAlert = document.getElementById("success-alert");

if (params.get("error") === "invalidemail") {
    errorAlert.textContent = "Invalid email format.";
    errorAlert.style.display = "block";
}

/* =========================
   ADMIN SERVICES ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".edit-service-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {

      const id = btn.getAttribute("data-id");
      const title = btn.getAttribute("data-title");
      const description = btn.getAttribute("data-description");
      const price = btn.getAttribute("data-price");

      const serviceId = document.getElementById("service_id");
      const serviceTitle = document.getElementById("service_title");
      const serviceDescription = document.getElementById("service_description");
      const servicePrice = document.getElementById("service_price");
      const formTitle = document.getElementById("service-form-title");

      if (!serviceId || !serviceTitle || !serviceDescription || !servicePrice || !formTitle) {
        return;
      }

      serviceId.value = id;
      serviceTitle.value = title;
      serviceDescription.value = description;
      servicePrice.value = price;

      formTitle.innerText = "Edit Service";

      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });

    });
  });

  document.querySelectorAll(".delete-service-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const id = btn.getAttribute("data-id");
      deleteService(id);
    });
  });

});

function resetServiceForm() {
  const serviceId = document.getElementById("service_id");
  const serviceTitle = document.getElementById("service_title");
  const serviceDescription = document.getElementById("service_description");
  const servicePrice = document.getElementById("service_price");
  const formTitle = document.getElementById("service-form-title");

  if (!serviceId || !serviceTitle || !serviceDescription || !servicePrice || !formTitle) {
    return;
  }

  serviceId.value = "";
  serviceTitle.value = "";
  servicePrice.value = "";
  serviceDescription.value = "";
  formTitle.innerText = "Add New Service";
}

function saveService() {
  const serviceId = document.getElementById("service_id");
  const serviceTitle = document.getElementById("service_title");
  const serviceDescription = document.getElementById("service_description");
  const servicePrice = document.getElementById("service_price");

  if (!serviceId || !serviceTitle || !serviceDescription || !servicePrice) {
    return;
  }

  const data = {
    id: serviceId.value,
    title: serviceTitle.value,
    description: serviceDescription.value,
    price: servicePrice.value
  };

  const url = data.id ? "../api/update-service.php" : "../api/add-service.php";

  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  })
  .then(function (response) {
    return response.json();
  })
  .then(function (res) {
    alert(res.message || "Saved successfully");
    location.reload();
  })
  .catch(function () {
    alert("Something went wrong while saving.");
  });
}

function deleteService(id) {
  if (!confirm("Delete this service?")) {
    return;
  }

  fetch("../api/delete-service.php?id=" + encodeURIComponent(id))
    .then(function (response) {
      return response.json();
    })
    .then(function (res) {
      alert(res.message || "Deleted successfully");
      location.reload();
    })
    .catch(function () {
      alert("Something went wrong while deleting.");
    });
}

/* =========================
   ADMIN PACKAGES ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".delete-package-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const id = btn.getAttribute("data-id");
      deletePackage(id);
    });
  });

});

function addPackage() {
  const nameInput = document.getElementById("pkg_name");
  const priceInput = document.getElementById("pkg_price");
  const slugInput = document.getElementById("pkg_slug");
  const descInput = document.getElementById("pkg_desc");

  if (!nameInput || !priceInput || !slugInput || !descInput) {
    return;
  }

  const data = {
    package_name: nameInput.value,
    price: priceInput.value,
    slug: slugInput.value,
    description: descInput.value
  };

  fetch("../api/add-package.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  })
  .then(function (response) {
    return response.json();
  })
  .then(function (res) {
    alert(res.message || "Package added successfully");
    location.reload();
  })
  .catch(function () {
    alert("Something went wrong while adding package.");
  });
}

function deletePackage(id) {
  if (!confirm("Delete this package?")) {
    return;
  }

  fetch("../api/delete-package.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ id: id })
  })
  .then(function (response) {
    return response.json();
  })
  .then(function (res) {
    alert(res.message || "Package deleted successfully");
    location.reload();
  })
  .catch(function () {
    alert("Something went wrong while deleting package.");
  });
}

/* =========================
   ADMIN BOOKINGS ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".update-booking-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const id = btn.getAttribute("data-id");
      const status = btn.getAttribute("data-status");
      updateBookingStatus(id, status);
    });
  });

  document.querySelectorAll(".delete-booking-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const id = btn.getAttribute("data-id");
      deleteBooking(id);
    });
  });

  document.querySelectorAll(".booking-filter-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const status = btn.getAttribute("data-status");
      filterBookingCards(status);
    });
  });

});

function updateBookingStatus(id, status) {
  fetch("../api/update-booking-status.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      id: id,
      status: status
    })
  })
  .then(function (response) {
    return response.json();
  })
  .then(function (res) {
    alert(res.message || "Booking updated");
    location.reload();
  })
  .catch(function () {
    alert("Something went wrong while updating booking.");
  });
}

function deleteBooking(id) {
  if (!confirm("Delete this booking?")) {
    return;
  }

  fetch("../api/delete-booking.php?id=" + encodeURIComponent(id))
    .then(function (response) {
      return response.json();
    })
    .then(function (res) {
      alert(res.message || "Booking deleted");
      location.reload();
    })
    .catch(function () {
      alert("Something went wrong while deleting booking.");
    });
}

function filterBookingCards(status) {
  document.querySelectorAll(".booking-card").forEach(function (card) {
    const cardStatus = card.getAttribute("data-status");

    if (status === "all" || status === cardStatus) {
      card.style.display = "";
    } else {
      card.style.display = "none";
    }
  });
}

/* =========================
   ADMIN FEEDBACK ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".delete-feedback-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const id = btn.getAttribute("data-id");
      deleteFeedback(id);
    });
  });

  const feedbackSearch = document.getElementById("feedback-search");

  if (feedbackSearch) {
    feedbackSearch.addEventListener("input", function () {
      searchFeedback(feedbackSearch.value);
    });
  }

});

function deleteFeedback(id) {
  if (!confirm("Delete this feedback?")) {
    return;
  }

  fetch("../api/delete-feedback.php?id=" + encodeURIComponent(id))
    .then(function (response) {
      return response.json();
    })
    .then(function (res) {
      alert(res.message || "Feedback deleted successfully");
      location.reload();
    })
    .catch(function () {
      alert("Something went wrong while deleting feedback.");
    });
}

function searchFeedback(searchValue) {
  const container = document.getElementById("feedback-results");

  if (!container) {
    return;
  }

  fetch("../api/search-feedback.php?search=" + encodeURIComponent(searchValue))
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      let html = "";

      if (!data.length) {
        html = "<p>No feedback found.</p>";
      } else {
        data.forEach(function (item) {
          html += `
            <div class="card feedback-card">

              <h3 class="card-title">${escapeFeedbackHtml(item.client_name || "")}</h3>

              <p class="card-text"><strong>Email:</strong> ${escapeFeedbackHtml(item.email || "")}</p>
              <p class="card-text"><strong>Rating:</strong> ${escapeFeedbackHtml(item.rating || "")}</p>
              <p class="card-text"><strong>Services:</strong> ${escapeFeedbackHtml(item.services_used || "")}</p>
              <p class="card-text"><strong>Style:</strong> ${escapeFeedbackHtml(item.style_preference || "")}</p>
              <p class="card-text"><strong>Comments:</strong> ${escapeFeedbackHtml(item.comments || "")}</p>

              <button
                type="button"
                class="btn btn-dark btn-full"
                onclick="deleteFeedback('${item.id}')"
              >
                Delete
              </button>

            </div>
          `;
        });
      }

      container.innerHTML = html;
    });
}

function escapeFeedbackHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}