import { useEffect, useState } from 'react';
import { fetchJobOrders } from '../services/api';

interface JobOrder {
  id: number;
  order_id: string;
  client: string;
  service: string;
  status: string;
}

export default function JobOrders() {
  const [orders, setOrders] = useState<JobOrder[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchJobOrders()
      .then((data) => setOrders(data))
      .finally(() => setLoading(false));
  }, []);

  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <h1 className="text-2xl font-semibold">Job Orders</h1>
        <p className="text-slate-500">View and manage your active work orders.</p>
      </div>
      <div className="rounded-3xl bg-white p-6 shadow-sm">
        <div className="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
          {loading ? (
            <div className="col-span-full py-10 text-center text-slate-500">Loading job orders…</div>
          ) : (
            orders.map((order) => (
              <div key={order.id} className="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                <div className="text-sm font-semibold text-slate-600">Order ID</div>
                <div className="mt-2 text-lg font-semibold text-slate-900">{order.order_id}</div>
                <div className="mt-4 text-sm text-slate-500">Client: {order.client}</div>
                <div className="text-sm text-slate-500">Service: {order.service}</div>
                <span className="mt-4 inline-flex rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">
                  {order.status}
                </span>
              </div>
            ))
          )}
        </div>
      </div>
    </section>
  );
}
