export default function Reports() {
  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <h1 className="text-2xl font-semibold">Reports</h1>
        <p className="text-slate-500">View sales, rental, project, and performance reports.</p>
      </div>
      <div className="grid gap-4 xl:grid-cols-2">
        {[
          { title: 'Sales Overview', description: 'Check recent revenue performance.' },
          { title: 'Rental Summary', description: 'See equipment rental trends.' },
          { title: 'Project Health', description: 'Track active project status.' },
          { title: 'Client Activity', description: 'Review recent customer interactions.' },
        ].map((report) => (
          <div key={report.title} className="rounded-3xl bg-white p-6 shadow-sm">
            <div className="text-sm font-semibold uppercase tracking-wide text-slate-500">{report.title}</div>
            <p className="mt-3 text-slate-700">{report.description}</p>
          </div>
        ))}
      </div>
    </section>
  );
}
