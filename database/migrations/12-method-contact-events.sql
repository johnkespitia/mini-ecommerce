alter table contacts add column method enum('Llamada', 'Correo', 'Whatsapp', 'SMS', 'Visita', 'Videollamada', 'Redes Sociales', 'Otro') not null;