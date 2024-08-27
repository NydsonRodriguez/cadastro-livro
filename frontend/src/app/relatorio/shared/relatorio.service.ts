import { Injectable } from "@angular/core";
import { Observable } from "rxjs";
import { WebApiService } from '../../service/web-api.service';
import { environment } from '../../../environments/environment'

var apiUrl = environment.endpointApi;

var httpLink = {
  create: apiUrl + "livro/create",
  read: apiUrl + "livro/read",
  edit: apiUrl + "livro/edit",
  update: apiUrl + "livro/update",
  delete: apiUrl + "livro/delete",
  // Auxiliares
  readAutor: apiUrl + "autor/read",
  readAssunto: apiUrl + "assunto/read",
}

@Injectable({
  providedIn: "root",
})
export class RelatorioService {
  constructor(private webApiService: WebApiService) {}

  public create(model: any): Observable<any> {
    return this.webApiService.post(httpLink.create, model);
  }

  public read(): Observable<any> {
    return this.webApiService.get(httpLink.read);
  }

  public edit(id: number): Observable<any> {
    return this.webApiService.get(httpLink.edit + '/' + id);
  }

  public update(model: any, id: number): Observable<any> {
    return this.webApiService.put(httpLink.update + '/' + id, model);
  }

  public delete(id: any): Observable<any> {
    return this.webApiService.delete(httpLink.delete + '/' + id);
  }

  //
  public readAutor(): Observable<any> {
    return this.webApiService.get(httpLink.readAutor);
  }
  public readAssunto(): Observable<any> {
    return this.webApiService.get(httpLink.readAssunto);
  }
}
