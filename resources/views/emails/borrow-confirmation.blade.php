<x-mail::message>
# {{ $itemType }} Borrowed Successfully

Hello **{{ $userName }}**,

Your borrow request has been approved. Here are the details of your borrowed item:

---

### Borrowed Item Details

| Field | Information |
|-------|-------------|
| **Item Type** | {{ $itemType }} |
| **Title** | {{ $itemTitle }} |
| **Borrow Date** | {{ $borrowDate }} |
| **Due Date** | {{ $dueDate }} |

---

### Borrowing Rules & Guidelines

Please adhere to the following library policies:

1. **Borrowing Period**: The due date is fixed. Items must be returned on or before the due date.
2. **Overdue Fines**: Late returns may incur fines as per library policy. Please return items promptly to avoid penalties.
3. **Item Care**: Handle all borrowed materials with care. Damaged or lost items will be subject to replacement fees.
4. **Renewals**: Contact the librarian if you need to extend your borrowing period. Renewals are subject to availability.
5. **Returns**: Items must be returned to the library desk during operating hours.
6. **Notifications**: You will receive email reminders before your due date. Please ensure your email address is up to date.

---

If you have any questions or concerns, please contact the library staff.

Thank you for using the **{{ config('app.name') }}**.

<x-mail::button :url="url('/')">
Go to Library System
</x-mail::button>

Best regards,<br>
**{{ config('app.name') }} Team**
</x-mail::message>
