import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { AutorComponent } from './autor/autor.component';
import { AssuntoComponent } from './assunto/assunto.component';
import { LivroComponent } from './livro/livro.component';
import { RelatorioComponent } from './relatorio/relatorio.component';

const routes: Routes = [
  {path: '', component: HomeComponent},
  {path: 'autor', component: AutorComponent},
  {path: 'assunto', component: AssuntoComponent},
  {path: 'livro', component: LivroComponent},
  {path: 'relatorio', component: RelatorioComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
