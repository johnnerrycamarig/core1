export default function Rental() {
  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h1 className="text-2xl font-semibold">Rental Management</h1>
            <p className="text-slate-500">Add and manage rental transactions.</p>
          </div>
          <button className="rounded-full bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">New Rental</button>
        </div>
      </div>
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="grid gap-6 lg:grid-cols-2">
          {[
            { label: 'Customer', value: 'Select customer' },
            { label: 'Item', value: 'Select item' },
            { label: 'Quantity', value: 'Enter quantity' },
            { label: 'Rental Date', value: 'Select rental date' },
            { label: 'Return Date', value: 'Select return date' },
            { label: 'Rental Fee', value: '₱ 0.00' },
            { label: 'Deposit', value: '₱ 0.00' },
          ].map((field) => (
            <div key={field.label} className="rounded-3xl border border-slate-200 bg-slate-50 p-4">
              <div className="text-sm font-semibold text-slate-600">{field.label}</div>
              <div className="mt-2 text-slate-700">{field.value}</div>
            </div>
          ))}
        </div>
        <button className="mt-6 rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Save Rental</button>
      </div>
    </section>
  );
}
