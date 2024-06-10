<x-filament::widget>
    <x-filament::card>
        <div>
            <canvas id="jugadoresPorDiaChart"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('jugadoresPorDiaChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($dates),
                        datasets: [{
                            label: 'Jugadores Nuevos por Día',
                            data: @json($counts),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Fecha'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Número de Jugadores Nuevos'
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </x-filament::card>
</x-filament::widget>
