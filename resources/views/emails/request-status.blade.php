@php
$statusColor = $status === 'Approved' ? '#198754' : '#dc3545';
@endphp

<x-mail::message>
# {{ ucfirst($requestType) }} Request {{ $status }}

Hello **{{ $userName }}**,

Your {{ strtolower($requestType) }} request has been **{{ $status }}**.

---

### Request Details

| Field | Information |
|-------|-------------|
| **Request Type** | {{ ucfirst($requestType) }} |
| **Item** | {{ $itemTitle }} |
| **Status** | {{ $status }}

@if($status === 'Approved' && $dueDate)
| **Due Date** | {{ $dueDate }} |
@endif

@if($notes)
| **Notes** | {{ $notes }} |
@endif

---

@if($status === 'Approved')
### Next Steps

Please proceed to the library desk to claim your {{ strtolower($requestType) }}. Bring your student ID and this email notification as proof.

If you have any questions, please contact the library staff.
@else
### What to do next?

If you believe this was an error or have questions about the decision, please visit the library or contact the staff for assistance.
@endif

---

If you have any questions or concerns, please do not hesitate to reach out to the library staff.

Thank you,<br>
**{{ config('app.name') }} Team**
</x-mail::message>
