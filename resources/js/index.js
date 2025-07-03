import * as checkIns from './checkins';

document.addEventListener('DOMContentLoaded', () => {
    // Fetch and display check-ins when the page loads
    fetchCheckIns();
});

// Add event listener for the form submissions
const checkInForm = document.querySelector('#check-in-form');
if (checkInForm) {
    checkInForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent the default form submission
        const formData = new FormData(checkInForm);
        const btnText = document.querySelector('.submit-check-in').textContent;

        if (btnText === 'Update') {
            updateCheckIn(formData);
        } else {
            createCheckIn(formData);
        }
    });
}

// Add event listener for the reset button
const resetBtn = document.querySelector('.reset-form');
resetBtn.addEventListener('click', (e) => {
    e.preventDefault();
    resetForm();
});

/**
 * Fetches check-in data and updates the check-in table and pagination links in the DOM.
 * 
 * Clears existing table rows and pagination elements, retrieves check-in data asynchronously,
 * populates the table with new check-in entries, and updates pagination controls.
 *
 * Relies on external functions:
 * - checkIns.getCheckIns(): Promise resolving to check-in data and pagination links.
 * - addCheckInToTable(checkIn): Adds a single check-in entry to the table.
 * - updateLinks(links): Updates pagination controls based on provided links.
 */
function fetchCheckIns(url = '/check-ins') {
    const tableBody = document.querySelector('.check-in-list');
    tableBody.innerHTML = ''; // Clear existing rows
    const previous = document.querySelector('.prev');
    previous.innerHTML = ''; // Clear existing pagination
    const next = document.querySelector('.next');
    next.innerHTML = ''; // Clear existing pagination

    checkIns.getCheckIns(url).then(data => {
        for (let checkIn of data.data) {
            addCheckInToTable(checkIn);
        }
        updateLinks(data.links); // Update pagination links
    });
}

/**
 * Adds a check-in entry as a new row to the check-in table in the DOM.
 * 
 * @param {Object} checkIn - The check-in data to add to the table.
 * @param {number|string} checkIn.id - The unique identifier for the check-in.
 * @param {string} checkIn.description - The description of the check-in.
 * @param {number} checkIn.lat - The latitude of the check-in location.
 * @param {number} checkIn.lng - The longitude of the check-in location.
 * @param {string|Date} checkIn.created_at - The creation date/time of the check-in.
 * 
 * @returns {void}
 */
function addCheckInToTable(checkIn) {
    const tableBody = document.querySelector('.check-in-list');
    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <a href="#" class="text-blue-600 hover:underline view-checkin-link" data-checkin-id="${checkIn.id}">${checkIn.description}</a>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${checkIn.lat}, ${checkIn.lng}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(checkIn.created_at).toLocaleString()}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer delete-checkin-btn" data-checkin-id="${checkIn.id}">
                Delete
            </button>
        </td>
    `;

    // Add event listener for the view link
    const viewLink = row.querySelector('.view-checkin-link');
    viewLink.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.form-title').textContent = 'Update Check-In';
        checkIns.viewCheckIn(checkIn.id);
    });

    // Add event listener for the delete button
    const deleteBtn = row.querySelector('.delete-checkin-btn');
    deleteBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this check-in?')) {
            const response = await checkIns.deleteCheckIn(checkIn.id);
            if (response.status === 200) {
                console.log('Check-in deleted successfully');
                fetchCheckIns(); // Refresh the check-ins list after deletion
            } else {
                console.error('Error deleting check-in:', response);
            }
        }
    });

    tableBody.appendChild(row);
}

/**
 * Updates the pagination links in the DOM based on the provided links object.
 *
 * @param {Object} links - An object containing pagination URLs.
 * @param {string} [links.prev] - The URL for the previous page. If provided, updates the element with class 'prev'.
 * @param {string} [links.next] - The URL for the next page. If provided, updates the element with class 'next'.
 */
function updateLinks(links) {
    if (links.prev) {
        const previous = document.querySelector('.prev');
        const prevLink = document.createElement('a');
        prevLink.href = '#';
        prevLink.addEventListener('click', (e) => {
            e.preventDefault();
            fetchCheckIns(links.prev); // Use fetchCheckIns to load the previous page
        });
        prevLink.textContent = 'Previous';
        prevLink.className = 'px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-l hover:bg-gray-50';
        previous.appendChild(prevLink);
    }

    if (links.next) {
        const next = document.querySelector('.next');
        const nextLink = document.createElement('a');
        nextLink.href = '#';
        nextLink.addEventListener('click', (e) => {
            e.preventDefault();
            fetchCheckIns(links.next); // Use fetchCheckIns to load the next page
        });
        nextLink.textContent = 'Next';
        nextLink.className = 'px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-r hover:bg-gray-50';
        next.appendChild(nextLink);
    }
}

async function createCheckIn(formData) {
    // If the button text is 'Submit', we are creating a new check-in
    try {
        const response = await checkIns.createCheckIn(Object.fromEntries(formData.entries()));
        if (response.status === 201) {
            fetchCheckIns(); // Refresh the check-ins list after adding a new one
            checkInForm.reset(); // Reset the form after submission
        } else {
            console.error('Error creating check-in:', response);
        }
    } catch (error) {
        document.querySelectorAll('.error').forEach(label => label.textContent = '');
        // console.error('Error adding check-in:', error.response.data.errors);
        // Display validation errors
        const errors = error.response.data.errors;
        if (errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const inputField = document.querySelector(`#${field}`);
                if (inputField && inputField.value === '') {
                    const errorLabel = inputField.nextElementSibling; // Assuming the label is the next sibling
                    if (errorLabel) {
                        errorLabel.textContent = messages[0]; // Display the first error message
                        errorLabel.classList.add('text-red-500', 'text-sm'); // Add styling for error
                    }
                }
            }
        }
    }
}

async function updateCheckIn(formData) {
    // If the button text is 'Update', we are updating an existing check-in
    const checkInId = document.querySelector('#check-in-id').value;
    try {
        const response = await checkIns.updateCheckIn(checkInId, Object.fromEntries(formData.entries()));
        fetchCheckIns(); // Refresh the check-ins list after updating
        resetForm(); // Reset the form after submission
    } catch (error) {
        document.querySelectorAll('.error').forEach(label => label.textContent = '');
        // Display validation errors
        const errors = error.response.data.errors;
        if (errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const inputField = document.querySelector(`#${field}`);
                if (inputField && inputField.value === '') {
                    const errorLabel = inputField.nextElementSibling; // Assuming the label is the next sibling
                    if (errorLabel) {
                        errorLabel.textContent = messages[0]; // Display the first error message
                        errorLabel.classList.add('text-red-500', 'text-sm'); // Add styling for error
                    }
                }
            }
        }
    }
}

/**
 * Resets the check-in form to its initial state.
 * - Clears all form fields.
 * - Empties the check-in ID input.
 * - Resets the submit button text to "Submit".
 */
function resetForm() {
    document.getElementById('check-in-form').reset();
    document.getElementById('check-in-id').value = '';
    document.querySelector('.submit-check-in').textContent = 'Submit';
    document.querySelector('#_method').value = 'POST';
    document.querySelector('.form-title').textContent = 'Create Check-In'; // Reset form title
    const errorLabels = document.querySelectorAll('.text-red-500');
    errorLabels.forEach(label => {
        label.textContent = ''; // Clear error messages
        label.classList.remove('text-red-500', 'text-sm'); // Remove error styling
    });
}

