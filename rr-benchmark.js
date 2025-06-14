// Yes this script is purely vibe coded

import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  stages: [
    { duration: '30s', target: __ENV.VU || 20 }, // Ramp up to 20 users
    { duration: '1m', target: __ENV.VU || 20 },  // Stay at 20 users
    { duration: '30s', target: 0 },  // Ramp down to 0 users
  ],
  thresholds: {
    http_req_duration: ['p(95)<500'], // 95% of requests should be below 500ms
    http_req_failed: ['rate<0.01'],   // Less than 1% of requests should fail
  },
};

const BASE_URL = __ENV.BASE_URL || 'http://localhost:8080';

export default function () {
  // Test RoadRunner endpoint
  const rrResponse = http.get(`${BASE_URL}/rr/`);
  check(rrResponse, {
    'roadrunner status is 200': (r) => r.status === 200,
    'roadrunner response time < 500ms': (r) => r.timings.duration < 500,
  });

  sleep(1);
} 