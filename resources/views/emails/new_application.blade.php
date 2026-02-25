<x-mail::message>
# New Application Submitted 📑

A new university application has been submitted by **{{ $application->name }}** and is awaiting document upload and initial review.

<x-mail::panel>
**Applicant Name:** {{ $application->name }}  
**Application ID:** #APP-{{ 1000 + $application->id }}  
**University:** {{ $application->course->university->name ?? 'N/A' }}  
**Course:** {{ $application->course->name ?? 'N/A' }}  
**Nationality:** {{ $application->nationality }}
</x-mail::panel>

The student will start uploading their required documents shortly. Please track the progress in the staff dashboard.

<x-mail::button :url="route('staff.dashboard')">
Open Staff Dashboard
</x-mail::button>

Best Regards,<br>
{{ config('app.name') }} Automated System
</x-mail::message>
