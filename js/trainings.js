// function openTrainingModal(title, description, image) {
//     const modal = document.getElementById('trainingModal');
//     document.getElementById('modalTitle').innerText = title;
//     document.getElementById('modalDescription').innerText = description;
//     document.getElementById('modalImage').src = image;
//     modal.style.display = 'flex';
// }
//
// function closeTrainingModal() {
//     document.getElementById('trainingModal').style.display = 'none';
// }

// --- Функционал просмотра карточки ---
function openViewModal(training) {
    document.getElementById('viewTitle').textContent = training.title;
    document.getElementById('viewImage').src = training.image;
    document.getElementById('viewDescription').textContent = training.description;
    document.getElementById('viewModal').style.display = 'flex';
}

function closeViewModal() {
    document.getElementById('viewModal').style.display = 'none';
}

// --- Функционал добавления/редактирования ---
function openAdminModal(training = null) {
    if (training) {
        document.getElementById('adminId').value = training.id;
        document.getElementById('adminTitle').value = training.title;
        document.getElementById('adminDescription').value = training.description;
        document.getElementById('adminImage').value = training.image;
    } else {
        clearAdminFields();
    }
    document.getElementById('adminModal').style.display = 'flex';
}

function closeAdminModal() {
    document.getElementById('adminModal').style.display = 'none';
}

function clearAdminFields() {
    document.getElementById('adminId').value = '';
    document.getElementById('adminTitle').value = '';
    document.getElementById('adminDescription').value = '';
    document.getElementById('adminImage').value = '';
}

function deleteTraining(id) {
    if (confirm('Вы уверены, что хотите удалить тренировку?')) {
        fetch('../handlers/trainingsHandler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'delete', id })
        }).then(() => location.reload());
    }
}

function submitAdminForm(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById('adminForm'));
    const data = Object.fromEntries(formData.entries());
    data.action = data.id ? 'edit' : 'add';

    fetch('../handlers/trainingsHandler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(() => location.reload());
}
