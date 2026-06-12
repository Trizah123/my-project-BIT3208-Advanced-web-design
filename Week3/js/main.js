// ── Helper: show or clear an error message ──────────────────────
function showError(fieldId, message) {
  document.getElementById(fieldId).textContent = message;
}

function clearError(fieldId) {
  document.getElementById(fieldId).textContent = '';
}

// ── Main validation function ─────────────────────────────────────
function validateForm() {
  let isValid = true;

  // Clear all previous errors
  const errorIds = ['medNameError','categoryError','quantityError','priceError','expiryDateError','supplierError'];
  errorIds.forEach(id => clearError(id));
  document.getElementById('successMsg').textContent = '';

  // 1. Medicine Name — required, min 2 chars
  const medName = document.getElementById('medName').value.trim();
  if (medName === '') {
    showError('medNameError', 'Medicine name is required.');
    isValid = false;
  } else if (medName.length < 2) {
    showError('medNameError', 'Name must be at least 2 characters.');
    isValid = false;
  }

  // 2. Category — must select one
  const category = document.getElementById('category').value;
  if (category === '') {
    showError('categoryError', 'Please select a category.');
    isValid = false;
  }

  // 3. Quantity — required, positive number
  const quantity = document.getElementById('quantity').value;
  if (quantity === '') {
    showError('quantityError', 'Quantity is required.');
    isValid = false;
  } else if (isNaN(quantity) || Number(quantity) <= 0) {
    showError('quantityError', 'Quantity must be a positive number.');
    isValid = false;
  }

  // 4. Price — required, positive number
  const price = document.getElementById('price').value;
  if (price === '') {
    showError('priceError', 'Price is required.');
    isValid = false;
  } else if (isNaN(price) || Number(price) <= 0) {
    showError('priceError', 'Price must be a positive number.');
    isValid = false;
  }

  // 5. Expiry Date — required, must be a future date
  const expiryDate = document.getElementById('expiryDate').value;
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  if (expiryDate === '') {
    showError('expiryDateError', 'Expiry date is required.');
    isValid = false;
  } else if (new Date(expiryDate) <= today) {
    showError('expiryDateError', 'Expiry date must be in the future.');
    isValid = false;
  }

  // 6. Supplier — required
  const supplier = document.getElementById('supplier').value.trim();
  if (supplier === '') {
    showError('supplierError', 'Supplier name is required.');
    isValid = false;
  }

  return isValid;
}

// ── Add medicine row to table (DOM manipulation) ─────────────────
let rowCount = 0;

function addMedicineToTable(name, category, qty, price, expiry, supplier) {
  rowCount++;
  const tbody = document.getElementById('medicineTableBody');
  const row = document.createElement('tr');
  row.innerHTML = `
    <td>${rowCount}</td>
    <td>${name}</td>
    <td>${category}</td>
    <td>${qty}</td>
    <td>KSh ${Number(price).toFixed(2)}</td>
    <td>${expiry}</td>
    <td>${supplier}</td>
  `;
  tbody.appendChild(row);
}

// ── Form submit event listener ───────────────────────────────────
document.getElementById('medicineForm').addEventListener('submit', function(e) {
  e.preventDefault(); // stop page reload

  if (validateForm()) {
    // Read values
    const name     = document.getElementById('medName').value.trim();
    const category = document.getElementById('category').value;
    const qty      = document.getElementById('quantity').value;
    const price    = document.getElementById('price').value;
    const expiry   = document.getElementById('expiryDate').value;
    const supplier = document.getElementById('supplier').value.trim();

    // Add to table
    addMedicineToTable(name, category, qty, price, expiry, supplier);

    // Show success message
    document.getElementById('successMsg').textContent = '✅ Medicine added successfully!';

    // Clear the form
    document.getElementById('medicineForm').reset();
  }
});