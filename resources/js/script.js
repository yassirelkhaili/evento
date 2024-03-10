/**
 * @author Yassir Elkhaili
 * @license MIT
*/


document.addEventListener("DOMContentLoaded", () => {
    //handle element delete modal
    const deleteBtns = document.querySelectorAll('.deleteBtn');
    const deleteElementModal = document.getElementById('deleteModal');
    const deleteModalForm = deleteElementModal && deleteElementModal.querySelector("form");
    const csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute("content");
/**
 * @description sets the modal hidden inputs value to the elements id
 * @param {any} event
 * @returns {void}
 **/
    const handleDeleteBtnPress = (event) => {
        const eventTarget = event.target;
        if (eventTarget && eventTarget.hasAttribute("data-id")) {
            const elementId = eventTarget.getAttribute('data-id');
            deleteModalForm.action = deleteModalForm.action.replace('__ID__', elementId.trim());
        }
    }

    deleteBtns && deleteBtns.forEach((deleteBtn) => deleteBtn.addEventListener("click", handleDeleteBtnPress))
    //end handle element delete modal

    //data fetch function
    const fetchDataById = async (id, uri) => {
        const endpoint = uri + id;
        const options = {
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        }
        try {
            const response = await fetch(endpoint, options);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            throw new Error("Error fetching partner info " + error);
        }
    }

    const populateModal = (data, inputs) => {
        inputs.forEach((modalInput) => {
            if(modalInput.name !== "event_picture") {
                if (modalInput.tagName.toLowerCase() === 'select') {
                    for (const option of modalInput.options) {
                        if ((option.value === data.size) || (parseInt(option.value) === data.partnerID) || (option.textContent === data.role)) {
                            option.selected = true;
                            break;
                        }
                    }
                } else {
                    if (modalInput.name in data) modalInput.value = data[modalInput.name];
                }
            }
        });
    }

    const editPartnerModal = document.getElementById("editPartnerForm");
    const editAdvertModal = document.getElementById("editeventForm");
    const editUserModal = document.getElementById("editUserForm");

    const toggleSpinner = (modal) => {
        const spinner = document.getElementById("loader");
        if (spinner) {
            modal.classList.toggle("hidden");
            spinner.classList.toggle("flex");
            spinner.classList.toggle("hidden");
        }
    }
    //end data fetch function

    //handle element edit modal
    const editBtns = document.querySelectorAll(".editBtn");

    const editPartnerModalInputs = [];
    //get Partner Modal Inputs
    if (editPartnerModal) {
        editPartnerModalInputs.push(...editPartnerModal.querySelectorAll("input"));
        editPartnerModalInputs.push(...editPartnerModal.querySelectorAll("textarea"));
        const selectElement = editPartnerModal.querySelector("select");
        selectElement && editPartnerModalInputs.push(selectElement);
    }

    const editAdvertModalInputs = [];
    //get Partner Modal Inputs
    if (editAdvertModal) {
        editAdvertModalInputs.push(...editAdvertModal.querySelectorAll("input"));
        editAdvertModalInputs.push(...editAdvertModal.querySelectorAll("textarea"));
        const selectElement = editAdvertModal.querySelector("select");
        selectElement && editAdvertModalInputs.push(selectElement);
    }

    const editUserModalInputs = [];

    //get User Modal Inputs
    if (editUserModal) {
        editUserModalInputs.push(...editUserModal.querySelectorAll("input"));
        const selectElement = editUserModal.querySelector("select");
        selectElement && editUserModalInputs.push(selectElement);
    }

    const handleEditBtnPress = (event) => {
    const target = event.target;
    const id = target.getAttribute("data-id");

    if (editPartnerModal) {
    toggleSpinner(editPartnerModal); //toggle spinner animation
    //add elements id to form action
    editPartnerModal.action = (editPartnerModal.action).replace('__ID__', id);
    //fetch elements data
    fetchDataById(id, "/partner/partner/").then((data) => populateModal(data, editPartnerModalInputs)).catch((error) => console.error(error)).finally(() => toggleSpinner(editPartnerModal));
    }

    if (editAdvertModal) {
        toggleSpinner(editAdvertModal); //toggle spinner animation
        //add elements id to form action
        editAdvertModal.action = (editAdvertModal.action).replace('__ID__', id);
        //fetch elements data
        fetchDataById(id, "/dashboard/events/").then((data) => populateModal(data, editAdvertModalInputs)).catch((error) => console.error(error)).finally(() => toggleSpinner(editAdvertModal));
    }

    if (editUserModal) {
        toggleSpinner(editUserModal); //toggle spinner animation
        //add elements id to form action
        editUserModal.action = (editUserModal.action).replace('__ID__', id);
        //fetch elements data
        fetchDataById(id, "/dashboard/users/").then((data) => populateModal(data, editUserModalInputs)).catch((error) => console.error(error)).finally(() => toggleSpinner(editUserModal));
    }
    }

    editBtns && editBtns.forEach((editBtn) => editBtn.addEventListener("click", handleEditBtnPress));
    //end handle element edit modal

    //handle categories toggle

    const categoryContainers = document.querySelectorAll("[data-element='dropdown-button']");
    const categoryDropdown = document.getElementById("dropdown");
    const categoryButton = document.getElementById("dropdown-button");
    const categoryInput = document.getElementById("category_input");

    const handleCategoryContainerClick = (event) => {
        const eventTarget = event.target;
        // set category_name as button text
        if (categoryButton) categoryButton.firstElementChild.textContent = eventTarget.textContent;
        // toggle dropdown on click
        if (categoryDropdown) {
            categoryDropdown.classList.toggle("hidden");
            categoryDropdown.classList.toggle("block");
        }
        // add button value to search form
        categoryInput.value = eventTarget.value;    
    }
    categoryButton && categoryButton.addEventListener("click",  () => categoryDropdown.classList.toggle("hidden"));
    categoryContainers && categoryContainers.forEach(categoryContainer => {
        categoryContainer.addEventListener("click", handleCategoryContainerClick); 
    });
    const toggleCategorySearchDropdown = (event) => {
        const eventTarget = event.target;
       if (categoryDropdown) {
        if (!categoryDropdown.contains(eventTarget) && !categoryButton.contains(eventTarget) && !categoryDropdown.classList.contains("hidden")) {
            categoryDropdown.classList.toggle("hidden");
        }
       }
    }
    document.addEventListener("click", toggleCategorySearchDropdown);
})

