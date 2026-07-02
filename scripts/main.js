/**
 * Lensora Studio — site interactivity
 * Main JavaScript file handling UI behavior, forms, admin actions, and API calls
 *
 * <!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206257
  Section: DAR
  Date: 5/6/2026
-->
 */

document.addEventListener("DOMContentLoaded", function () {

  // Initialize core UI features when DOM is ready
  updateActiveNavLink();
  setupFormValidation();
  setupBookingRequestForm();
  setupScheduleInteractivity();
  setupGalleryAnimations();
  setupServiceAnimations();
  setupSchedulePage();

  // Control visibility of admin booking action buttons based on status
  document.querySelectorAll(".booking-card").forEach(card => {
    const status = card.dataset.status;
    const buttons = card.querySelectorAll(".update-booking-btn");

    if (status === "pending") {
      buttons.forEach(btn => btn.style.display = "inline-block");
    } else {
      buttons.forEach(btn => btn.style.display = "none");
    }
  });
});

/**
 * Highlights active navigation link based on current page
 */
function updateActiveNavLink() {
  const bodyActive = document.body.getAttribute("data-nav-active");
  const currentPage = window.location.pathname.split("/").pop() || "index.html";

  document.querySelectorAll(".nav-links a").forEach(function (link) {
    link.classList.remove("active");

    const href = link.getAttribute("href");

    if (bodyActive) {
      // Special handling for gallery/work section
      if (href === "work.html" && bodyActive === "work") {
        link.classList.add("active");
      }
    } else if (href === currentPage || (currentPage === "" && href === "index.html")) {
      link.classList.add("active");
    }
  });
}

/**
 * Handles service selection and schedule slot interaction
 */
function setupScheduleInteractivity() {

  var serviceSelect = document.getElementById("booking-service");
  var dateInput = document.getElementById("booking-date");
  var timeInput = document.getElementById("booking-time");
  var slotHint = document.getElementById("slot-hint");
  var serviceButtons = document.querySelectorAll(".service-btn");

  if (serviceButtons.length === 0) return;

  // Service button selection
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

  // Sync dropdown with buttons
  if (serviceSelect) {
    serviceSelect.addEventListener("change", function () {
      var val = serviceSelect.value;

      serviceButtons.forEach(function (b) {
        b.classList.toggle("selected", b.getAttribute("data-service") === val);
      });
    });
  }

  // Time slot selection
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

/**
 * Booking request form validation and submission handling
 */
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

    // Success message after validation
    showNotification(
      "Booking request submitted. The studio will follow up to confirm your session.",
      "success"
    );

    form.reset();

    document.querySelectorAll(".slot.selected").forEach(s => s.classList.remove("selected"));
    document.querySelectorAll(".service-btn.selected").forEach(b => b.classList.remove("selected"));

    var hint = document.getElementById("slot-hint");
    if (hint) hint.textContent = "";

    console.log("Booking request:", Object.fromEntries(fd));
  });
}

/**
 * Feedback form setup and submission
 */
function setupFormValidation() {
  var feedbackForm = document.getElementById("feedback-form");

  if (feedbackForm) {
    feedbackForm.addEventListener("submit", handleFormSubmit);
  }
}

/**
 * Handles feedback submission with validation + API call
 */
function handleFormSubmit(e) {
  e.preventDefault();

  var form = e.target;
  var formData = new FormData(form);

  var name = formData.get("name");
  var email = formData.get("email");
  var rating = formData.get("rating");
  var services = formData.getAll("services");
  var style_preference = formData.get("style-preference");
  var comments = formData.get("comments");

  var errors = [];

  if (!name || !name.trim()) errors.push("Name is required");
  if (!email || !email.trim()) errors.push("Email is required");
  else if (!isValidEmail(email)) errors.push("Invalid email");
  if (!rating) errors.push("Rating required");
  if (services.length === 0) errors.push("Select at least one service");

  if (errors.length > 0) {
    showNotification(errors.join("\n"), "error");
    return;
  }

  // Send feedback to backend API
  fetch("../api/add-feedback.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      name,
      email,
      rating,
      services,
      style_preference,
      comments
    })
  })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        showNotification("Thank you! Feedback submitted.", "success");
        form.reset();
      } else {
        showNotification(data.message || "Submission failed", "error");
      }
    })
    .catch(err => {
      console.error(err);
      showNotification("Server error", "error");
    });
}

/**
 * Email validation helper
 */
function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(email));
}

/**
 * Global notification popup system
 */
function showNotification(message, type) {
  type = type || "info";

  var notification = document.createElement("div");
  notification.className = "notification notification-" + type;
  notification.innerHTML = message.replace(/\n/g, "<br>");

  notification.style.cssText =
    "position:fixed;top:20px;right:20px;padding:1.5rem;border-radius:0.5rem;color:white;font-weight:600;z-index:1000;max-width:400px;box-shadow:0 5px 15px rgba(0,0,0,0.2);";

  if (type === "success") notification.style.backgroundColor = "#10b981";
  else if (type === "error") notification.style.backgroundColor = "#ef4444";
  else notification.style.backgroundColor = "#9b7ebd";

  document.body.appendChild(notification);

  setTimeout(function () {
    notification.remove();
  }, 5000);
}

/**
 * Smooth scroll for anchor links
 */
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

/**
 * Gallery animation on scroll (fade-in effect)
 */
function setupGalleryAnimations() {
  var galleryItems = document.querySelectorAll(".gallery-item");
  if (galleryItems.length === 0) return;

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: "0px 0px -100px 0px" });

  galleryItems.forEach(item => observer.observe(item));
}

/**
 * Service cards animation on scroll
 */
function setupServiceAnimations() {
  var serviceCards = document.querySelectorAll(".service-card");
  if (serviceCards.length === 0) return;

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry, index) {
      if (entry.isIntersecting) {
        entry.target.style.animation =
          "fadeIn 0.6s ease-out " + index * 0.1 + "s both";

        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: "0px 0px -100px 0px" });

  serviceCards.forEach(card => observer.observe(card));
}

/**
 * Login/Register tab switcher
 */
function showForm(type) {
  let forms = document.querySelectorAll("form");
  let btnLogin = document.getElementById("tab-login-btn");
  let btnRegister = document.getElementById("tab-register-btn");

  forms.forEach(f => f.classList.remove("active"));

  if (btnLogin) btnLogin.classList.remove("active");
  if (btnRegister) btnRegister.classList.remove("active");

  const activeForm = document.getElementById(type);
  if (activeForm) activeForm.classList.add("active");

  if (type === "login") btnLogin?.classList.add("active");
  else btnRegister?.classList.add("active");
}

/**
 * Handle URL error/success messages on auth page
 */
document.addEventListener("DOMContentLoaded", function () {

  const urlParams = new URLSearchParams(window.location.search);

  const error = urlParams.get("error");
  const success = urlParams.get("success");
  const tab = urlParams.get("tab");

  const errorBox = document.querySelector(".auth-container .alert-error");
  const successBox = document.querySelector(".auth-container .alert-success");

  if (tab && typeof showForm === "function") {
    showForm(tab);
  }

  // Error handling
  if (error && errorBox) {
    errorBox.style.display = "block";

    if (error === "invalid") {
      errorBox.innerText = "Invalid email or password ❌";
    } else if (error === "exists") {
      errorBox.innerText = "Email already exists ⚠️";
    } else if (error === "empty") {
      errorBox.innerText = "Please fill all fields ⚠️";
    } else if (error === "weakpassword") {
      errorBox.innerText =
        "Password is too weak ❌ Must be 8+ characters, include uppercase, lowercase, number & symbol.";
    } else if (error === "invalidname") {
      errorBox.innerText = "Name must contain letters and spaces only ❌";
    } else if (error === "invalidemail") {
      errorBox.innerText = "Invalid email format ❌";
    }
  }

  // Success handling
  if (success === "registered" && successBox) {
    successBox.style.display = "block";
    successBox.innerText = "Account created successfully ✔️";
  }
});

/**
 * Toggle password visibility
 */
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

/* =========================
   ADMIN SERVICES ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".edit-service-btn").forEach(btn => {
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

      if (!serviceId || !serviceTitle || !serviceDescription || !servicePrice || !formTitle) return;

      serviceId.value = id;
      serviceTitle.value = title;
      serviceDescription.value = description;
      servicePrice.value = price;

      formTitle.innerText = "Edit Service";

      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });

  document.querySelectorAll(".delete-service-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      deleteService(btn.getAttribute("data-id"));
    });
  });

});

/**
 * Reset service form fields
 */
function resetServiceForm() {
  const serviceId = document.getElementById("service_id");
  const serviceTitle = document.getElementById("service_title");
  const serviceDescription = document.getElementById("service_description");
  const servicePrice = document.getElementById("service_price");
  const formTitle = document.getElementById("service-form-title");

  if (!serviceId || !serviceTitle || !serviceDescription || !servicePrice || !formTitle) return;

  serviceId.value = "";
  serviceTitle.value = "";
  servicePrice.value = "";
  serviceDescription.value = "";
  formTitle.innerText = "Add New Service";
}

/**
 * Save service (add or update)
 */
function saveService() {
  const serviceId = document.getElementById("service_id");
  const serviceTitle = document.getElementById("service_title");
  const serviceDescription = document.getElementById("service_description");
  const servicePrice = document.getElementById("service_price");

  const data = {
    id: serviceId.value,
    title: serviceTitle.value,
    description: serviceDescription.value,
    price: servicePrice.value
  };

  const url = data.id ? "../api/update-service.php" : "../api/add-service.php";

  fetch(url, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Saved successfully");
      location.reload();
    })
    .catch(() => alert("Something went wrong while saving."));
}

/**
 * Delete service
 */
function deleteService(id) {
  if (!confirm("Delete this service?")) return;

  fetch("../api/delete-service.php?id=" + encodeURIComponent(id))
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Deleted successfully");
      location.reload();
    })
    .catch(() => alert("Something went wrong while deleting."));
}

/* =========================
   ADMIN PACKAGES ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".delete-package-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      deletePackage(btn.getAttribute("data-id"));
    });
  });

});

/**
 * Add package
 */
function addPackage() {
  const nameInput = document.getElementById("pkg_name");
  const priceInput = document.getElementById("pkg_price");
  const slugInput = document.getElementById("pkg_slug");
  const descInput = document.getElementById("pkg_desc");

  const data = {
    package_name: nameInput.value,
    price: priceInput.value,
    slug: slugInput.value,
    description: descInput.value
  };

  fetch("../api/add-package.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Package added successfully");
      location.reload();
    })
    .catch(() => alert("Something went wrong while adding package."));
}

/**
 * Delete package
 */
function deletePackage(id) {
  if (!confirm("Delete this package?")) return;

  fetch("../api/delete-package.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Package deleted successfully");
      location.reload();
    })
    .catch(() => alert("Something went wrong while deleting package."));
}

/* =========================
   ADMIN BOOKINGS ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".update-booking-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      updateBookingStatus(btn.getAttribute("data-id"), btn.getAttribute("data-status"));
    });
  });

  document.querySelectorAll(".delete-booking-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      deleteBooking(btn.getAttribute("data-id"));
    });
  });

  document.querySelectorAll(".booking-filter-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      filterBookingCards(btn.getAttribute("data-status"));
    });
  });

});

/**
 * Update booking status
 */
function updateBookingStatus(id, status) {
  fetch("../api/update-booking-status.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id, status })
  })
    .then(res => res.json())
    .then(data => {

      if (data.status !== "success") {
        alert(data.message || "Update failed");
        return;
      }

      const card = document.querySelector(`.booking-card button[data-id="${id}"]`)?.closest(".booking-card");
      if (!card) return;

      const statusLabel = card.querySelector(".booking-status");
      statusLabel.textContent = "Status: " + status;
      statusLabel.className = "booking-status booking-status-" + status;

      card.dataset.status = status;
      toggleBookingButtons(card, status);

      alert("Booking updated successfully");
    })
    .catch(() => alert("Something went wrong while updating booking."));
}

/**
 * Toggle booking buttons based on status
 */
function toggleBookingButtons(card, status) {
  const actionButtons = card.querySelectorAll(".update-booking-btn");

  actionButtons.forEach(btn => {
    btn.style.display = (status === "pending") ? "inline-block" : "none";
  });
}

/**
 * Delete booking
 */
function deleteBooking(id) {
  if (!confirm("Delete this booking?")) return;

  fetch("../api/delete-booking.php?id=" + encodeURIComponent(id))
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Booking deleted");
      location.reload();
    })
    .catch(() => alert("Something went wrong while deleting booking."));
}

/**
 * Filter booking cards
 */
function filterBookingCards(status) {
  document.querySelectorAll(".booking-card").forEach(card => {
    const cardStatus = card.getAttribute("data-status");
    card.style.display = (status === "all" || status === cardStatus) ? "" : "none";
  });
}

/* =========================
   ADMIN FEEDBACK ACTIONS
========================= */

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".delete-feedback-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      deleteFeedback(btn.getAttribute("data-id"));
    });
  });

  const feedbackSearch = document.getElementById("feedback-search");

  if (feedbackSearch) {
    feedbackSearch.addEventListener("input", function () {
      searchFeedback(feedbackSearch.value);
    });
  }

});

/**
 * Delete feedback
 */
function deleteFeedback(id) {
  if (!confirm("Delete this feedback?")) return;

  fetch("../api/delete-feedback.php?id=" + encodeURIComponent(id))
    .then(res => res.json())
    .then(res => {
      alert(res.message || "Feedback deleted successfully");
      location.reload();
    })
    .catch(() => alert("Something went wrong while deleting feedback."));
}

/**
 * Search feedback
 */
function searchFeedback(searchValue) {
  const container = document.getElementById("feedback-results");

  fetch("../api/search-feedback.php?search=" + encodeURIComponent(searchValue))
    .then(res => res.json())
    .then(data => {

      let html = "";

      if (!data.length) {
        html = "<p>No feedback found.</p>";
      } else {
        data.forEach(item => {
          html += `
            <div class="card feedback-card">

              <h3 class="card-title">${escapeFeedbackHtml(item.client_name || "")}</h3>

              <p><strong>Email:</strong> ${escapeFeedbackHtml(item.email || "")}</p>
              <p><strong>Rating:</strong> ${escapeFeedbackHtml(item.rating || "")}</p>
              <p><strong>Services:</strong> ${escapeFeedbackHtml(item.services_used || "")}</p>
              <p><strong>Style:</strong> ${escapeFeedbackHtml(item.style_preference || "")}</p>
              <p><strong>Comments:</strong> ${escapeFeedbackHtml(item.comments || "")}</p>

              <button class="btn btn-dark btn-full" onclick="deleteFeedback('${item.id}')">
                Delete
              </button>

            </div>
          `;
        });
      }

      container.innerHTML = html;
    });
}

/**
 * Escape HTML for safety
 */
function escapeFeedbackHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

/* =========================
   PACKAGES SECTION
========================= */

let allPackages = [];

/**
 * Load packages from API
 */
fetch("../api/get-package.php")
  .then(res => res.json())
  .then(data => {
    if (data.status === "success") {
      allPackages = data.data;
      render(allPackages);
    }
  });

/**
 * Render packages
 */
function render(packages) {
  const container = document.getElementById("packages-container");

  if (!container) return;

  container.innerHTML = packages.map(pkg => `
    <li class="package-card">
      <h3>${pkg.package_name}</h3>
      <p class="price">$${pkg.price}</p>
      <p>${pkg.description}</p>
      <a href="schedule.php?package=${pkg.slug}" class="btn btn-primary btn-full">
        Book Now
      </a>
    </li>
  `).join("");
}

/**
 * Package search filter
 */
const searchInput = document.getElementById("search");
if (searchInput) {
  searchInput.addEventListener("input", function (e) {
    const keyword = e.target.value.toLowerCase();

    const filtered = allPackages.filter(pkg =>
      pkg.package_name.toLowerCase().includes(keyword)
    );

    render(filtered);
  });
}

/* =========================
   SERVICES FILTER
========================= */

function filterServices() {

  const search = document.getElementById("search")?.value || "";
  const min = document.getElementById("minPrice")?.value || 0;
  const max = document.getElementById("maxPrice")?.value || 999999;

  fetch(`../api/search-service.php?search=${encodeURIComponent(search)}&min=${min}&max=${max}`)
    .then(res => res.json())
    .then(res => {

      const container = document.getElementById("servicesGrid");
      if (!container) return;

      if (!res.data) {
        container.innerHTML = "<p>Error loading services</p>";
        return;
      }

      container.innerHTML = res.data.map(s => `
        <div class="service-card">
          <h3>${s.title}</h3>
          ${s.image ? `<img src="../${s.image}" alt="">` : ""}
          <p>${s.description}</p>
          <p class="price">Starting from <strong>$${s.price}</strong></p>
          <a href="packages.php?service=${encodeURIComponent(s.title)}"
             class="btn btn-primary btn-full">
             Choose Package
          </a>
        </div>
      `).join("");
    });
}

/**
 * Toggle filter panel
 */
function toggleFilters() {
  const panel = document.getElementById("filterPanel");
  if (!panel) return;

  panel.style.display = (panel.style.display === "block") ? "none" : "block";
}

/**
 * Reset filters
 */
function resetFilters() {
  const search = document.getElementById("search");
  const min = document.getElementById("minPrice");
  const max = document.getElementById("maxPrice");

  if (search) search.value = "";
  if (min) min.value = "";
  if (max) max.value = "";

  filterServices();
}

/* =========================
   SCHEDULE PAGE
========================= */

function setupSchedulePage() {

  const monthSelect = document.getElementById("month-select");
  if (!monthSelect) return;

  const tableHead = document.getElementById("table-head");
  const body = document.getElementById("schedule-body");

  let bookedSlots = [];

  // Load booked slots from API
  async function loadBookedSlots() {
    try {
      const response = await fetch("../api/get-booked-slots.php");
      bookedSlots = await response.json();
      render();
    } catch (err) {
      console.error(err);
    }
  }

  const params = new URLSearchParams(window.location.search);
  const pkg = params.get("package");

  if (pkg) {
    document.getElementById("selected-package").textContent =
      "Selected Package: " + pkg.toUpperCase();
  }

  const times = ["10:00 AM", "12:00 PM", "02:00 PM", "04:00 PM", "06:00 PM"];

  function initMonths() {
    const now = new Date();

    for (let i = 0; i < 4; i++) {
      const d = new Date(now.getFullYear(), now.getMonth() + i, 1);

      monthSelect.add(
        new Option(
          d.toLocaleDateString("en-US", { month: "long", year: "numeric" }),
          i
        )
      );
    }
  }

  function render() {
    const now = new Date();
    const offset = parseInt(monthSelect.value);

    const year = now.getFullYear();
    const month = now.getMonth() + offset;

    let dates = [];
    let d = new Date(year, month, 1);

    while (d.getMonth() === (month % 12)) {

      if ([0, 2, 4].includes(d.getDay())) {

        if (offset === 0 && d < now) {
          d.setDate(d.getDate() + 1);
          continue;
        }

        dates.push(new Date(d));
      }

      d.setDate(d.getDate() + 1);
    }

    tableHead.innerHTML = `
      <tr>
        <th>Time</th>
        ${dates.map(date => `
          <th>
            ${date.toLocaleDateString("en-US", { weekday: "short" })}
            <br>
            ${date.getDate()}
          </th>
        `).join("")}
      </tr>
    `;

    body.innerHTML = times.map(time => `
      <tr>
        <td>${time}</td>
        ${dates.map(date => {
          const dateString = date.toISOString().split("T")[0];

          const available = !bookedSlots.some(slot =>
            slot.booking_date === dateString &&
            slot.booking_time === time
          );

          return `
            <td class="time-slot-cell ${available ? "available" : "booked"}"
                data-date="${dateString}"
                data-time="${time}">
              ${available ? "●" : "✕"}
            </td>
          `;
        }).join("")}
      </tr>
    `).join("");
  }

  document.addEventListener("click", function (e) {

    const cell = e.target.closest(".time-slot-cell.available");
    if (!cell) return;

    if (!userIsLoggedIn) {
      showNotification("Please log in first ⚠️", "error");
      setTimeout(() => window.location.href = "auth.php", 2000);
      return;
    }

    document.querySelectorAll(".time-slot-cell.selected")
      .forEach(c => c.classList.remove("selected"));

    cell.classList.add("selected");

    document.getElementById("selected-date").value = cell.dataset.date;
    document.getElementById("selected-time").value = cell.dataset.time;
  });

  const bookingForm = document.getElementById("booking-form");

  if (bookingForm) {
    bookingForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const packageText = document.getElementById("selected-package")
        .textContent.replace("Selected Package: ", "").trim();

      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const date = document.getElementById("selected-date").value.trim();
      const time = document.getElementById("selected-time").value.trim();

      if (!packageText || packageText === "—") {
        showNotification("Select a package first ⚠️", "error");
        return;
      }

      if (!date || !time || !name || !email) {
        showNotification("Fill all fields ⚠️", "error");
        return;
      }

      fetch("../api/create-booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ package: packageText, date, time, name, email })
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === "success") {
            showNotification("Booking requested! Visit your Profile page to view your booking status. ✔️", "success");
            loadBookedSlots();
            bookingForm.reset();
          } else {
            showNotification(data.message || "Booking failed", "error");
          }
        })
        .catch(() => showNotification("Server error", "error"));
    });
  }

  initMonths();
  loadBookedSlots();
  monthSelect.addEventListener("change", render);
}