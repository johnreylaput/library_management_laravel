<x-mail::message>
# {{ $status === 'Overdue' ? 'Overdue: Please return your borrowed item' : 'Reminder: Your borrowed item is due soon' }}

Hello {{ $userName }},

This is a reminder that your borrowed item is {{ $status === 'Overdue' ? 'overdue' : 'due soon' }}.

**Item:** {{ $itemTitle }}  
**Due Date:** {{ $dueDate }}

{{ $status === 'Overdue' ? 'Please return the item as soon as possible to avoid additional fines.' : 'Please return the item on or before the due date.' }}

<x-mail::button :url="url('/')">
Go to Library System
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
