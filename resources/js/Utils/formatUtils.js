export function formatDate(date) {
	return new Intl.DateTimeFormat(
		"en-CA",
		{
			year: "numeric",
			month: "2-digit",
			day: "2-digit",
			timeZone: "Asia/Manila",
		}
	)
		.format(new Date(date))
		.split("/")
		.reverse()
		.join("-");
}
