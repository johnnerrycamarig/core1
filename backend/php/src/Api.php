<?php

namespace App;

class Api
{
    public function handle(string $request): array
    {
        $uri = parse_url($request, PHP_URL_PATH);
        if ($uri === '/clients') {
            return $this->respond(200, [
                ['id' => 1, 'name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@email.com'],
                ['id' => 2, 'name' => 'Maria Santos', 'email' => 'maria.santos@email.com'],
            ]);
        }

        if ($uri === '/job-orders') {
            return $this->respond(200, [
                ['id' => 1, 'order_id' => 'JO-001', 'service' => 'Printing', 'status' => 'Ongoing'],
                ['id' => 2, 'order_id' => 'JO-002', 'service' => 'Rental', 'status' => 'Completed'],
            ]);
        }

        return $this->respond(404, ['message' => 'Not found']);
    }

    private function respond(int $status, array $data): array
    {
        return ['status' => $status, 'data' => $data];
    }
}
