export default function Projects() {
  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h1 className="text-2xl font-semibold">Project Management</h1>
            <p className="text-slate-500">Manage project details and track progress.</p>
          </div>
          <button className="rounded-full bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">New Project</button>
        </div>
      </div>
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="grid gap-6 lg:grid-cols-2">
          <div className="space-y-4">
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-4">
              <div className="text-sm font-semibold text-slate-600">Project Name</div>
              <div className="mt-2 text-slate-700">Enter project name</div>
            </div>
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-4">
              <div className="text-sm font-semibold text-slate-600">Project Manager</div>
              <div className="mt-2 text-slate-700">Enter project manager</div>
            </div>
          </div>
          <div className="space-y-4">
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-4">
              <div className="text-sm font-semibold text-slate-600">Client</div>
              <div className="mt-2 text-slate-700">Select client</div>
            </div>
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-4">
              <div className="text-sm font-semibold text-slate-600">Status</div>
              <div className="mt-2 text-slate-700">Ongoing</div>
            </div>
          </div>
        </div>
        <div className="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-4">
          <div className="flex items-center justify-between">
            <div className="text-sm font-semibold text-slate-600">Progress</div>
            <div className="text-sm font-semibold text-slate-700">60%</div>
          </div>
          <div className="mt-3 h-3 overflow-hidden rounded-full bg-slate-200">
            <div className="h-full w-3/5 rounded-full bg-blue-600"></div>
          </div>
        </div>
        <div className="mt-6 space-y-3 rounded-3xl border border-slate-200 bg-slate-50 p-4">
          {['Design', 'Printing', 'Delivery'].map((task) => (
            <label key={task} className="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3">
              <input type="checkbox" className="h-4 w-4 rounded border-slate-300 text-blue-600" />
              <span className="text-slate-700">{task}</span>
            </label>
          ))}
        </div>
        <button className="mt-6 rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Update Project</button>
      </div>
    </section>
  );
}
