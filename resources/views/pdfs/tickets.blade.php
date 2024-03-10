<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket.pdf</title>
</head>
<body>
    <ul>
        <li>Event Title: {{$ticket->event->title}}</li>
        <li>Date: {{$ticket->event->date}}</li>
        <li>Address: {{$ticket->event->address}}</li>
        <li>Description: {{$ticket->event->description}}</li>
        <li>Category: @if(isset($ticket->event->category)) {{$ticket->event->category->name}} @endif</li>
        <li>Validation Method: {{$ticket->event->validation_method}}</li>
        <li>TicketId: {{$ticket->uuid}}</li>
    </ul>    
</body>
</html>