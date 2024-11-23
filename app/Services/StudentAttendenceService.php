<?php

namespace App\Services;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
class StudentAttendenceService {

    public function markAttendance(Collection $records, $attendanceDate, $attendenceModel, $studentModel)
    {
        // Step 1: Mark selected students as present
        $markedStudentIds = [];
        foreach ($records as $record) {
            $attendenceModel::updateOrCreate(
                [
                    'student_id' => $record->id,
                    'attendance_date' => Carbon::parse($attendanceDate),
                ],
                ['status' => 'present']
            );
            $markedStudentIds[] = $record->id;
        }

        // Step 2: Mark remaining students as absent
        $allStudentIds = $studentModel::pluck('id'); // Adjust Student model as necessary
        $absentStudentIds = $allStudentIds->diff($markedStudentIds);

        foreach ($absentStudentIds as $studentId) {
            $attendenceModel::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'attendance_date' => Carbon::parse($attendanceDate),
                ],
                ['status' => 'absent']
            );
        }

        // Notification for attendance submission
        Notification::make()
            ->title('Attendance Submitted!')
            ->body("Attendance Marked Successfully.")
            ->success()
            ->send();
    }

}
