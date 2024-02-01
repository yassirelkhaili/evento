/**
 * @author Yassir Elkhaili
 * @license MIT
*/


document.addEventListener("DOMContentLoaded", () => {
    //handle element delete modal
    const deleteBtns = document.querySelectorAll('.deleteBtn');
    const deleteElementModal = document.getElementById('deleteModal');
    const deleteModalForm = deleteElementModal.querySelector("form");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
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
            if (modalInput.tagName.toLowerCase() === 'select') {
                for (const option of modalInput.options) {
                    if (option.value === data.size) {
                        option.selected = true;
                        break;
                    }
                }
            } else {
                if (modalInput.id in data) modalInput.value = data[modalInput.id];
            }
        });
    }

    const editPartnerModal = document.getElementById("editPartnerForm");

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
    const updatePartnerModal = document.getElementById("updatePartnerModal");
    const editPartnerModalInputs = [];
    //get Partner Modal Inputs
    if (updatePartnerModal) {
        editPartnerModalInputs.push(...updatePartnerModal.querySelectorAll("input"));
        editPartnerModalInputs.push(...updatePartnerModal.querySelectorAll("textarea"));
        const selectElement = updatePartnerModal.querySelector("select");
        if (selectElement) {
            editPartnerModalInputs.push(selectElement);
        }
    }

    const handleEditBtnPress = (event) => {
    toggleSpinner(editPartnerModal); //toggle spinner animation
    const target = event.target;
    const id = target.getAttribute("data-id");
    //add elements id to form action
    editPartnerModal.action = (editPartnerModal.action).replace('__ID__', id);
    //fetch elements data
    fetchDataById(id, "/partner/partner/").then((data) => populateModal(data, editPartnerModalInputs)).catch((error) => console.error(error)).finally(() => toggleSpinner(editPartnerModal));
    }

    editBtns && editBtns.forEach((editBtn) => editBtn.addEventListener("click", handleEditBtnPress));
    //end handle element edit modal
})

