// import { Head } from '@inertiajs/react';
// import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
// import { dashboard } from '@/routes';

// export default function Dashboard() {
//     return (
//         <>
//             <Head title="Dashboard" />
//             <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
//                 <div className="grid auto-rows-min gap-4 md:grid-cols-3">
//                     <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                     <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                     <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                 </div>
//                 <div className="relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
//                     <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                 </div>
//             </div>
//         </>
//     );
// }

// Dashboard.layout = {
//     breadcrumbs: [
//         {
//             title: 'Dashboard',
//             href: dashboard(),
//         },
//     ],
// };


import { Head, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

interface Product {
    id: string;
    name: string;
    description: string;
    price: string;
    stock: number;
    category: string;
}

interface Stats {
    total_products: number;
    total_stock: number;
    total_orders: number;
    pending_orders: number;
    revenue: number;
}

export default function Dashboard({ products, stats }: { products: Product[]; stats: Stats }) {
    const { data, setData, post, delete: destroy, reset, processing } = useForm({
        name: '',
        description: '',
        price: '',
        stock: 0,
        category: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post('/cms/productos', {
            onSuccess: () => reset(),
        });
    };

    return (
        <div className="p-6 max-w-6xl mx-auto space-y-8">
            <Head title="EliasCms - Panel" />
            <h1 className="text-3xl font-bold">EliasCms 🐧 — Panel de Tienda</h1>

            {/* Métricas de tu Dashboard original */}
            <div className="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div className="p-4 border rounded-lg bg-white shadow-sm">
                    <p className="text-sm text-gray-500">Productos</p>
                    <p className="text-2xl font-bold">{stats.total_products}</p>
                </div>
                <div className="p-4 border rounded-lg bg-white shadow-sm">
                    <p className="text-sm text-gray-500">Stock Total</p>
                    <p className="text-2xl font-bold">{stats.total_stock}</p>
                </div>
                <div className="p-4 border rounded-lg bg-white shadow-sm">
                    <p className="text-sm text-gray-500">Órdenes</p>
                    <p className="text-2xl font-bold">{stats.total_orders}</p>
                </div>
                <div className="p-4 border rounded-lg bg-white shadow-sm">
                    <p className="text-sm text-gray-500">Pendientes</p>
                    <p className="text-2xl font-bold text-amber-600">{stats.pending_orders}</p>
                </div>
                <div className="p-4 border rounded-lg bg-white shadow-sm">
                    <p className="text-sm text-gray-500">Ingresos</p>
                    <p className="text-2xl font-bold text-green-600">${stats.revenue}</p>
                </div>
            </div>

            {/* Formulario rápido para crear producto */}
            <form onSubmit={handleSubmit} className="p-4 border rounded-lg bg-gray-50 grid grid-cols-1 md:grid-cols-5 gap-3">
                <input
                    type="text"
                    placeholder="Nombre del producto"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    className="border p-2 rounded"
                    required
                />
                <input
                    type="text"
                    placeholder="Categoría"
                    value={data.category}
                    onChange={(e) => setData('category', e.target.value)}
                    className="border p-2 rounded"
                />
                <input
                    type="number"
                    step="0.01"
                    placeholder="Precio"
                    value={data.price}
                    onChange={(e) => setData('price', e.target.value)}
                    className="border p-2 rounded"
                    required
                />
                <input
                    type="number"
                    placeholder="Stock"
                    value={data.stock}
                    onChange={(e) => setData('stock', Number(e.target.value))}
                    className="border p-2 rounded"
                    required
                />
                <button
                    type="submit"
                    disabled={processing}
                    className="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700"
                >
                    + Agregar
                </button>
            </form>

            {/* Tabla CRUD de Productos */}
            <div className="border rounded-lg overflow-hidden">
                <table className="w-full text-left border-collapse">
                    <thead className="bg-gray-100 border-b">
                        <tr>
                            <th className="p-3">Nombre</th>
                            <th className="p-3">Categoría</th>
                            <th className="p-3">Precio</th>
                            <th className="p-3">Stock</th>
                            <th className="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {products.map((prod) => (
                            <tr key={prod.id} className="border-b">
                                <td className="p-3 font-medium">{prod.name}</td>
                                <td className="p-3 text-gray-500">{prod.category || 'General'}</td>
                                <td className="p-3 text-green-600 font-bold">${prod.price}</td>
                                <td className="p-3">{prod.stock}</td>
                                <td className="p-3">
                                    <button
                                        onClick={() => destroy(`/cms/productos/${prod.id}`)}
                                        className="text-red-600 hover:underline text-sm"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
