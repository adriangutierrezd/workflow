<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('New workout assigned')}}</title>

</head>
<body>
    <section
        style="padding: 2rem 1.5rem;background-color:#ffffff;">
    
        <main style="margin-top: 2rem;">
            <h2 style="color:#374151;">{{__('Hi')}} {{ $userTrainerRequest->trainer->name }}</h2>
    
            <p style="margin-top:0.5rem;line-height:2;color:#4B5563">
                {{ $userTrainerRequest->user->name }} {{__('wants you to be his trainer')}}.
            </p>

            @if($userTrainerRequest->message)
                <p style="margin-top:0.5rem;line-height:2;color:#4B5563">{{__('The request also contains a message')}}:</p>
                <p style="margin-top:0.5rem;line-height:2;color:#4B5563">{{ $userTrainerRequest->message }}</p>
            @endif
            

            <a
                style="display:inline-block;padding-top:0.5rem;padding-bottom:0.5rem;padding-left:1.5rem;padding-right:1.5rem;margin-top:1rem;border-radius:0.5rem;font-size:0.875rem;line-height:1.25rem;font-weight:500;letter-spacing:0.05em;color:#ffffff;text-transform:capitalize;background-color:#2563EB;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1),transition-duration:[300ms,300ms],:hover:{background-color:#3B82F6"
                href="{{route('user-trainer-request.accept', $userTrainerRequest->token)}}" target="_blank">
                {{__('Accept request')}}
            </a>

        </main>
        
        <footer style="margin-top:1rem;color:#6B7280">
            <p>© {{date('Y')}} {{ config('app.name', 'Workflow') }}. {{__('All rights reserved')}}.</p>
        </footer>
    </section>
</body>
</html>
