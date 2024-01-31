/**
 * @author Yassir Elkhaili
 * @license MIT
*/


document.addEventListener("DOMContentLoaded", () => {
    //handle element delete modal
    const deleteBtns = document.querySelectorAll('.deleteBtn');
    const deleteElementModal = document.getElementById('deleteModal');
    const deleteModalForm = deleteElementModal.querySelector("form");
/**
 * @description sets the modal hidden inputs value to the elements id
 * @param {any} event
 * @returns {void}
 **/
    const handleDeleteBtnPress = (event) => {
        const eventTarget = event.target;
        if (eventTarget && eventTarget.hasAttribute("data-partner-id")) {
            const elementId = eventTarget.getAttribute('data-partner-id');
            deleteModalForm.action = deleteModalForm.action.replace('__ID__', elementId.trim());
        }
    }

    deleteBtns && deleteBtns.forEach((deleteBtn) => deleteBtn.addEventListener("click", handleDeleteBtnPress))
    //end handle element delete modal
})

