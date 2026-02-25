<x-mail::message>
# Congratulations, {{ $application->name }}!

We are thrilled to inform you that your **Official Offer Letter** from **{{ $application->course->university->name }}** has been successfully issued for the **{{ $application->course->name }}** program!

<x-mail::panel>
**Application ID:** #APP-{{ 1000 + $application->id }}  
**University:** {{ $application->course->university->name }}  
**Course:** {{ $application->course->name }}  
**Intake:** {{ $application->intake }}
</x-mail::panel>

You can now log in to your dashboard to view, download, and review the terms of your offer letter. 

<x-mail::button :url="route('student.applications.show', $application->id)">
View My Offer Letter
</x-mail::button>

If you have any questions about the next steps or the tuition fee process, please don't hesitate to reach out to our team.

Best Regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
