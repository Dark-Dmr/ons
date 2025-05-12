{{-- ask jehad where to put it in his code  --}}
@extends('layouts.app')
<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Upload Word files only(.docx):</label>
    <input type="file" name="document" accept=".docx">
    <button type="submit">Convert to JSON</button>
</form>