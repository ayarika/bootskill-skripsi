<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Schedule</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      margin: 0;
      background: #f4f7fa;
      color: #333;
      line-height: 1.6;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
      font-weight: 600;
      color: #2c3e50;
    }

    .filter-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 25px;
      justify-content: center;
    }

    .filter-bar input,
    .filter-bar select,
    .filter-bar button {
      padding: 10px 12px;
      font-size: 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
      transition: all 0.2s ease;
    }

    .filter-bar input:focus,
    .filter-bar select:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
    }

    .btn-reset {
      background: linear-gradient(135deg, #f8997dff, #f8764eff);
      color: #fff;
      border: none;

      cursor: pointer;
      font-weight: 600;
    }

    .btn-reset:hover {
      background: linear-gradient(135deg, #fa9576ff, #f5663aff);
    }

    .add-form {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      margin-bottom: 35px;
      box-sizing: border-box;
    }

    .add-form h2 {
      margin-top: 0;
      margin-bottom: 15px;
      font-size: 22px;
      color: #2c3e50;
      text-align: center;
    }

    .add-form form {
      display: flex;
      flex-direction: column;
    }

    .add-form input,
    .add-form textarea,
    .add-form select {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      transition: border 0.2s ease, box-shadow 0.2s ease;
      box-sizing: border-box;
    }

    .add-form input:focus,
    .add-form textarea:focus,
    .add-form select:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 2px rgba(52,152,219,0.15);
    }

    .add-form button {
      background: linear-gradient(45deg, #2ecc71, #36de33ff);
      color: #fff;
      padding: 12px;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .add-form button:hover {
      background: linear-gradient(45deg, #29b765ff, #0fc10cff);

    }
    .add-form button:active {
      transform: scale(0.97);
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 22px;
    }

    .card {
      background: #fff;
      border-radius: 14px;
      padding: 18px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;

    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.12);
    }

    .card h3 {
      margin: 0 0 10px;
      font-size: 20px;
      color: #1d3557;
      font-weight: 600;
    }

    .card p {
      margin: 5px 0;
      font-size: 14px;
      color: #555;
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }

    .priority-urgent_important { background: #e74c3c; color: #fff; }
    .priority-urgent_not_important { background: #f39c12; color: #fff; }
    .priority-important_not_urgent { background: #3498db; color: #fff; }
    .priority-not_urgent_not_important { background: #7f8c8d; color: #fff; }

    .priority-urgent_important,
    .priority-urgent_not_important,
    .priority-important_not_urgent,
    .priority-not_urgent_not_important {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-weight: 600;    
      font-size: 12px;
      padding: 5px 10px;
      border-radius: 20px;
      text-transform: capitalize;
      letter-spacing: 0.3px;
      margin-top: 8px;
    }

    .card p strong {
      display: inline-block;
      width: 90px;
      color: #1d3557;
    }

    .actions {
      margin-top: 18px;
      display: flex;
      gap: 10px;
    }

    .actions button,
    .actions form button {
      flex: 1;
      padding: 9px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .actions button:active {
      transform: scale(0.96);
    }

    .edit-btn {
        background: linear-gradient(135deg, #66aef6ff, #79beedff);
        color: #fff; 
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #5fa9f3ff, #60b4ecff);
    }

    .delete-btn {
        background: linear-gradient(135deg, #f8997dff, #f8764eff);
        color: #fff; 
    }

    .delete-btn:hover { 
        background: linear-gradient(135deg, #fa9576ff, #f5663aff);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      inset: 0;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      padding: 40px 15px;
      box-sizing: border-box;
    }

    .modal.show { 
      display: flex;
    }

    .modal-content {
      background: #fff;
      padding: 25px 50px;
      width: 100%;
      max-width: 450px;
      max-height: 90vh;
      overflow-y: auto;
      border-radius: 12px;
      position: relative;
      transform: scale(0.9);
      opacity: 0;
      transition: all 0.25s ease-in-out;
      box-sizing: border-box;
    }

    .modal.show .modal-content {
      transform: scale(1);
      opacity: 1;
    }

    .close-btn {
      position: absolute;
      top: 12px;
      right: 16px;
      font-size: 22px;
      font-weight: bold;
      cursor: pointer;
      color: #666;
    }

    .modal-content h2 {
      margin: 0 0 18px;
      font-size: 22px;
      color: #2c3e50;
      text-align: center;
      margin-top: 20px;
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .modal-content input,
    .modal-content select,
    .modal-content textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      transition: border 0.2s ease, box-shadow 0.2s ease;
      margin: 0;
      box-sizing: border-box;
    }

    .modal-content input:focus,
    .modal-content select:focus,
    .modal-content textarea:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 2px rgba(52,152,219,0.15);
    }

    #editModal .modal-content button,
    #addModal .modal-content button {
      background: linear-gradient(45deg, #2ecc71, #0fd70bff);
      color: #fff;
      padding: 12px;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .modal-content select {
      background: #fff;
      background-size: 16px;
    }
    
    #editModal .modal-content button:hover,
    #addModal .modal-content button:hover {
        background: linear-gradient(45deg, #29b765ff, #0fc10cff);
    }
    
    #editModal .modal-content button:active,
    #addModal .modal-content button:active {
      transform: scale(0.97);
    }

    .back-btn {
      display: inline-block;
      padding: 10px 16px;
      color: #2e3a50;
      border-radius: 8px;
      font-size: 18px;
      margin-top: 40px;
      font-weight: 500;
      text-decoration: none;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .back-btn:active {
      transform: scale(0.96);
    }

    #deleteModal .modal-content {
      max-width: 400px;
      text-align: center;
    }

    #deleteModal p {
      font-size: 15px;
      margin-bottom: 20px;
      color: #444;
    }

    .delete-actions {
      display: flex;
      gap: 12px;
    }

    .delete-actions button {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      transition: background 0.2s ease, transform 0.1s ease;
    }

    .delete-actions button:active{
      transform: scale(0.95);
    }

    .confirm-delete {
      background: #e74c3c;
      color: #fff;
    }

    .confirm-delete:hover {
      background: #c0392b;
    }

    .cancel-delete {
      background: #b6babdff;
      color: #e5edf5ff;
    }

    .cancel-delete:hover {
      background: #9ba0a0ff;
    }

    .event-label {
      margin-top: 10px;
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      background: #ecf0f1;
      color: #34495e;
      font-size: 12px;
      font-weight: 600;
    }

  </style>
</head>
<body>
  <div class="container">

    <div style="margin-bottom:20px;">
        <a href="{{ route('myschedule') }}" class="back-btn">← Back to My Schedule</a>
    </div>
    <h1>Edit Schedule</h1>

    <div class="filter-bar">
      <input type="date" id="filter-date">
        <select id="filter-priority">
          <option value="">All Priorities</option>
          <option value="urgent_important">Urgent & Important</option>
          <option value="urgent_not_important">Urgent & Not Important</option>
          <option value="important_not_urgent">Important & Not Urgent</option>
          <option value="not_urgent_not_important">Not Urgent & Not Important</option>
        </select>
      <button type="button" class="btn-reset" id="reset-filter">Reset</button>
    </div>

    <div class="add-form">
      <h2>Add Schedule</h2>
        <form action="{{ route('myschedule.store') }}" method="POST">
          @csrf
          <input type="text" name="title" placeholder="Title" required>
          <textarea name="description" rows="3" placeholder="Description"></textarea>
          <input type="datetime-local" name="start_datetime" required>
          <input type="datetime-local" name="end_datetime" required>
          <select name="priority" required>
            <option value="urgent_important">Urgent & Important</option>
            <option value="urgent_not_important">Urgent & Not Important</option>
            <option value="important_not_urgent">Important & Not Urgent</option>
            <option value="not_urgent_not_important">Not Urgent & Not Important</option>
          </select>
          <input type="text" name="meeting_link" placeholder="Meeting Link (optional)">
          <button type="submit">Add</button>
        </form>
    </div>

    <div class="card-grid" id="schedule-list">
      @forelse ($schedules as $schedule)
        <div class="card"
            data-priority="{{ $schedule->priority }}"
            data-start="{{ \Carbon\Carbon::parse($schedule->start_datetime)->toDateString() }}"
            data-end="{{ \Carbon\Carbon::parse($schedule->end_datetime)->toDateString() }}">
          <h3>{{ Str::limit($schedule->title, 20) }}</h3>
          <p><strong>Description:</strong> {{ Str::limit($schedule->description, 30) ?? '-' }}</p>
          <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($schedule->start_datetime)->format('m/d/Y h:i A') }}</p>
          <p><strong>End:</strong> {{ \Carbon\Carbon::parse($schedule->end_datetime)->format('m/d/Y h:i A') }}</p>
          <p><strong>Priority:</strong>
            <span class="priority-{{ $schedule->priority }}">{{ ucfirst(str_replace('_',' ', $schedule->priority)) }}</span>
          </p>
          <p><strong>Meeting Link:</strong>
              @if($schedule->meeting_link)
                  <a href="{{ $schedule->meeting_link }}" target="_blank">{{ $schedule->meeting_link }}</a>
              @else
                  -
              @endif
          </p>

          <div class="actions">
              @if(!$schedule->is_from_event)
                <button class="edit-btn"
                    data-id="{{ $schedule->id }}"
                    data-update-url="{{ route('myschedule.update', $schedule->id) }}"
                    data-title="{{ $schedule->title }}"
                    data-start="{{ $schedule->start_datetime }}"
                    data-end="{{ $schedule->end_datetime }}"
                    data-desc="{{ $schedule->description }}"
                    data-priority="{{ $schedule->priority }}"
                    data-meeting="{{ $schedule->meeting_link }}">
                  Edit
                </button>

                <form action="{{ route('myschedule.destroy', $schedule->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn">Delete</button>
                </form>
              @else
                <span class="event-label">From Bootcamp</span>
              @endif
          </div>
        </div>
      @empty
        <p class="empty-schedule">
            You don't have any schedules yet.<br>
            Add a personal schedule or enroll in a bootcamp to see it here.
        </p>
      @endforelse
    </div>
  </div>

  <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Edit Schedule</h2>
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <input type="text" name="title" id="editTitle" required>
          <input type="datetime-local" name="start_datetime" id="editStart" required>
          <input type="datetime-local" name="end_datetime" id="editEnd" required>
          <textarea name="description" id="editDesc" rows="3"></textarea>
          <select name="priority" id="editPriority" required>
            <option value="urgent_important">Urgent & Important</option>
            <option value="urgent_not_important">Urgent & Not Important</option>
            <option value="important_not_urgent">Important & Not Urgent</option>
            <option value="not_urgent_not_important">Not Urgent & Not Important</option>
          </select>
          <input type="text" name="meeting_link" id="editMeeting" placeholder="Meeting Link">
          <button type="submit">Save</button>
        </form>
      </div>
  </div>

  <div id="deleteModal" class="modal">
      <div class="modal-content">
          <span class="close-btn" id="closeDelete">&times;</span>
          <h2>Confirm Delete</h2>
          <p>Are you sure you want to delete this schedule?</p>
          <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <div class="delete-actions">
                  <button type="button" class="cancel-delete">Cancel</button>
                  <button type="submit" class="confirm-delete">Delete</button>
              </div>
          </form>
      </div>
  </div>

  <script>
    const modal = document.getElementById('editModal');
    const closeBtn = document.getElementById('closeModal');
    const editForm = document.getElementById('editForm');

    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        modal.classList.add('show');
        const id = btn.dataset.id;
        editForm.action = btn.dataset.updateUrl;
        document.getElementById('editTitle').value = btn.dataset.title;
        document.getElementById('editStart').value = btn.dataset.start.replace(' ', 'T');
        document.getElementById('editEnd').value = btn.dataset.end.replace(' ', 'T');
        document.getElementById('editDesc').value = btn.dataset.desc || '';
        document.getElementById('editPriority').value = btn.dataset.priority;
        document.getElementById('editMeeting').value = btn.dataset.meeting || '';
      });
    });

    closeBtn.addEventListener('click', () => modal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('show'); });

    const priorityFilter = document.getElementById('filter-priority');
    const dateFilter = document.getElementById('filter-date');
    const resetBtn = document.getElementById('reset-filter');
    const cards = document.querySelectorAll('.card');

    function applyFilters() {
      const priority = priorityFilter.value;
      const date = dateFilter.value;
      cards.forEach(card => {
        const cardPriority = card.dataset.priority;
        const start = card.dataset.start;
        const end = card.dataset.end;
        let show = true;
        if (priority && cardPriority !== priority) show = false;
        if (date && (date < start || date > end)) show = false;
        card.style.display = show ? 'block' : 'none';
      });
    }
    priorityFilter.addEventListener('change', applyFilters);
    dateFilter.addEventListener('change', applyFilters);
    resetBtn.addEventListener('click', () => {
      priorityFilter.value = "";
      dateFilter.value = "";
      cards.forEach(card => card.style.display = 'block');
    });

    document.addEventListener("DOMContentLoaded", () => {
        const deleteModal = document.getElementById('deleteModal');
        const closeDeleteBtn = document.getElementById('closeDelete');
        const deleteForm = document.getElementById('deleteForm');

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                deleteModal.classList.add('show');
                deleteForm.action = btn.closest('form').action;
            });
        });

        closeDeleteBtn.addEventListener('click', () => deleteModal.classList.remove('show'));
        deleteModal.querySelector('.cancel-delete').addEventListener('click', () => deleteModal.classList.remove('show'));

        window.addEventListener('click', e => {
          if (e.target === deleteModal) deleteModal.classList.remove('show');
        });
    });

  </script>
</body>
</html>
