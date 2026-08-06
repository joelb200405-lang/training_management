/* ==========================================================================
   LOGOUT MODAL LOGIC
   ========================================================================== */

/**
 * Opens the logout confirmation modal
 */
function showLogoutModal() {
  const modal = document.getElementById('logoutModal');
  if (modal) {
    modal.style.display = 'flex';
  }
}

/**
 * Closes the logout confirmation modal
 */
function hideLogoutModal() {
  const modal = document.getElementById('logoutModal');
  if (modal) {
    modal.style.display = 'none';
  }
}

/**
 * Closes the modal if user clicks on the dark background overlay
 */
window.addEventListener('click', function (event) {
  const modal = document.getElementById('logoutModal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});
